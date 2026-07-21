<?php

namespace App\Services\SuperAdmin;

use App\Models\KnowledgeBase;
use App\Models\KnowledgeBaseSection;
use App\Models\Status;
use Illuminate\Support\Facades\DB;

class KnowledgeBaseService
{
    public function getAll($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $knowledgeBases = KnowledgeBase::withCount('sections')
            ->with(['sections.images'])
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        return $knowledgeBases;
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        
        try {
            $data['status_id'] = Status::getStatusIdBySlug('active');
            
            // Extract sections data
            $sections = $data['sections'] ?? [];
            unset($data['sections']);
            
            // Create knowledge base
            $knowledgeBase = KnowledgeBase::create($data);
            
            // Create sections
            foreach ($sections as $sectionData) {
                $section = KnowledgeBaseSection::create([
                    'knowledge_base_id' => $knowledgeBase->id,
                    'name' => $sectionData['name'],
                    'content' => $sectionData['content']
                ]);
                
                // Handle section image upload if provided
                if (isset($sectionData['image']) && $sectionData['image']) {
                    upload_image(
                        $section,
                        $sectionData['image'],
                        'knowledge-base-sections',
                        'section-image',
                        true,
                        false
                    );
                }
            }
            
            DB::commit();
            return $knowledgeBase->load('sections');
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(int $id, array $data)
    {
        DB::beginTransaction();
        
        try {
            // status check
            if(isset($data['status_id']))
            {
                switch($data['status_id'])
                {
                    case '0':
                        $data['status_id'] = Status::getStatusIdBySlug('inactive');
                    break;
                }
            }

            // Extract sections data
            $sections = $data['sections'] ?? [];
            unset($data['sections']);

            $knowledgeBase = KnowledgeBase::findOrFail($id);
            $knowledgeBase->update($data);
            
            // Update sections intelligently - only update changed sections
            if (!empty($sections)) {
                $existingSections = KnowledgeBaseSection::where('knowledge_base_id', $id)->get()->keyBy('id');
                $processedSectionIds = [];
                
                foreach ($sections as $index => $sectionData) {
                    // Check if this is an existing section (has an ID)
                    if (isset($sectionData['id']) && $existingSections->has($sectionData['id'])) {
                        // Update existing section
                        $existingSection = $existingSections->get($sectionData['id']);
                        $existingSection->update([
                            'name' => $sectionData['name'],
                            'content' => $sectionData['content']
                        ]);
                        
                        // Handle image upload if provided
                        if (isset($sectionData['image']) && $sectionData['image']) {
                            // Delete old image if exists
                            $existingSection->images()->delete();
                            
                            // Upload new image
                            upload_image(
                                $existingSection,
                                $sectionData['image'],
                                'knowledge-base-sections',
                                'section-image',
                                true,
                                false
                            );
                        }
                        
                        $processedSectionIds[] = $existingSection->id;
                    } else {
                        // Create new section
                        $section = KnowledgeBaseSection::create([
                            'knowledge_base_id' => $id,
                            'name' => $sectionData['name'],
                            'content' => $sectionData['content']
                        ]);
                        
                        // Handle section image upload if provided
                        if (isset($sectionData['image']) && $sectionData['image']) {
                            upload_image(
                                $section,
                                $sectionData['image'],
                                'knowledge-base-sections',
                                'section-image',
                                true,
                                false
                            );
                        }
                        
                        $processedSectionIds[] = $section->id;
                    }
                }
                
                // Delete sections that were not processed (removed from form)
                $sectionsToDelete = $existingSections->whereNotIn('id', $processedSectionIds);
                foreach ($sectionsToDelete as $sectionToDelete) {
                    $sectionToDelete->images()->delete();
                    $sectionToDelete->delete();
                }
            }
            
            DB::commit();
            return $knowledgeBase->fresh()->load('sections');
            
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id)
    {
        return KnowledgeBase::with('sections.images')->where('id',$id)->first();
    }

    public function delete($id)
    {
        return KnowledgeBase::where('id',$id)->delete();
    }
}