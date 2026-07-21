<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Template;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Template::create($this->_createHomePageTemplate1());
    }

    private function _createHomePageTemplate1(): array
    {
        return [
            'name' => 'homePageTemplate1',
            'keys' => '{
                    "NavbarSection": {
                        "0": "Logo",
                        "1": "Home",
                        "2": "Portal",
                        "3": "Knowledge Base",
                        "4": "Job Notice Board",
                        "5": "Events",
                        "6": "Contact Us",
                        "7": "Sign In Button"
                    },
                    "HeroSection1": {
                        "0": "Title",
                        "1": "Description",
                        "2": "Background Image",
                        "4": "Right Side Image",
                        "5": "Register Now Button",
                        "6": "Learn More Button"
                    },
                    "HeroSection2": {
                        "0": "Title",
                        "1": "Description",
                        "2": "Background Image",
                        "4": "Right Side Image",
                        "5": "Register Now Button",
                        "6": "Learn More Button"
                    },
                    "HeroSection3": {
                        "0": "Title",
                        "1": "Description",
                        "2": "Background Image",
                        "4": "Right Side Image",
                        "5": "Register Now Button",
                        "6": "Learn More Button"
                    },
                    "AmbassadorMessageSection": {
                        "0": "Title",
                        "1": "Subtitle",
                        "2": "Image",
                        "3": "Description"
                    },
                    "WhyNeedUsSection": {
                        "0": "Title",
                        "1": "Subtitle",
                        "2": "Description",
                        "3": "Image",
                        "4": {
                            "Business Growth": {
                                "Icon": "Image",
                                "Title": "Text",
                                "Description": "Text"
                            }
                        },
                        "5": {
                            "Talent Discovery": {
                                "Icon": "Image",
                                "Title": "Text",
                                "Description": "Text"
                            }
                        },
                        "6": "Register Now Button"
                    },
                    "BenefitsSection": {
                        "0": "Title",
                        "1": "Subtitle",
                        "2": {
                            "Cards": {
                                "For All User": {
                                    "Image": "Image",
                                    "Title": "Text",
                                    "Description": "Text",
                                    "Icon": "Image"
                                },
                                "For Diaspora": {
                                    "Image": "Image",
                                    "Title": "Text",
                                    "Description": "Text",
                                    "Icon": "Image"
                                },
                                "For Non-Diaspora": {
                                    "Image": "Image",
                                    "Title": "Text",
                                    "Description": "Text",
                                    "Icon": "Image"
                                },
                                "For Embassy": {
                                    "Image": "Image",
                                    "Title": "Text",
                                    "Description": "Text",
                                    "Icon": "Image"
                                }
                            }
                        }
                    },
                    "HowItWorksSection": {
                        "0": "Title",
                        "1": "Subtitle",
                        "2": {
                            "Steps": {
                                "Step 1": {
                                    "Step": "Text", 
                                    "Title": "Text",
                                    "Description": "Text"
                                },
                                "Step 2": {
                                    "Step": "Text",
                                    "Title": "Text",
                                    "Description": "Text"
                                },
                                "Step 3": {
                                    "Step": "Text",
                                    "Title": "Text",
                                    "Description": "Text"
                                }
                            }
                        },
                        "3": "Side Image",
                        "4": "Register Now Button"
                    },
                    "EventsSection": {
                        "0": "Title Icon",
                        "1": "Title",
                        "2": "Subtitle",
                        "3": "View More Events Button"
                    },
                    "CallToActionSection": {
                        "0": "Title",
                        "1": "Description",
                        "2": "Background Image",
                        "3": "Get Started Now Button"
                    },
                    "FooterSection": {
                        "0": "Logo",
                        "1": "Description",
                        "2": {
                            "Useful Links": {
                                "Portal": {
                                    "Text": "Text",
                                    "url": "#"
                                },
                                "Knowledge Base": {
                                    "Text": "Text",
                                    "url": "#"
                                },
                                "Job Notice Board": {
                                    "Text": "Text",
                                    "url": "#"
                                },
                                "Events": {
                                    "Text": "Text",
                                    "url": "#"
                                }
                            }
                        },
                        "3": {
                            "Newsletter": {
                                "Title": "Text",
                                "Description": "Text",
                                "Email Input Placeholder": "Text",
                                "Image": "Image"
                            }
                        },
                        "4": {
                            "Bottom": {
                                "Description": "Text"
                            }
                        },
                        "5": {
                            "Links": {
                                "Terms & Conditions": {
                                    "Text": "Text",
                                    "url": "#"
                                },
                                "Privacy Policy": {
                                    "Text": "Text",
                                    "url": "#"
                                },
                                "Contact Us": {
                                    "Text": "Text",
                                    "url": "#"
                                }
                            }
                        }
                    }
                }',
            'template_image' => 'images/templates/home_page_template.png',
            'template_file_path' => 'template1',
            'status' => 'Active',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
    }
}
