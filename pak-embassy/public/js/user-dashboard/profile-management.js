/**
 * Profile Management JavaScript
 * Handles Education, Experience, and Certification CRUD operations
 */

class ProfileManager {
    constructor() {
        this.init();
    }

    init() {
        this.bindEvents();
    }

    bindEvents() {
        // Education events
        $(document).on('click', '.removeEduEntry', (e) => this.deleteEducation(e));
        $(document).on('click', '.editEdu', (e) => this.editEducation(e));

        // Experience events
        $(document).on('click', '.removeExpEntry', (e) => this.deleteExperience(e));
        $(document).on('click', '.editExp', (e) => this.editExperience(e));

        // Certification events
        $(document).on('click', '.removeCertEntry', (e) => this.deleteCertification(e));
        $(document).on('click', '.editCert', (e) => this.editCertification(e));
    }

    // Education methods
    deleteEducation(e) {
        e.preventDefault();
        const educationId = $(e.currentTarget).data('education-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/user/profile/education/${educationId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        if (response.success) {
                            $(`[data-education-id="${educationId}"]`).fadeOut(300, function () {
                                $(this).remove();
                            });
                            Swal.fire(
                                'Deleted!',
                                'Education record has been deleted.',
                                'success'
                            );
                        }
                    },
                    error: (xhr) => {
                        Swal.fire(
                            'Error!',
                            'Failed to delete education record.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    editEducation(e) {
        e.preventDefault();
        const educationId = $(e.currentTarget).data('education-id');

        // Clear any previous editing data
        window.editingEducation = null;
        window.editingEducationId = null;

        // Fetch education data from backend
        $.ajax({
            url: `/user/profile/education/${educationId}`,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success) {
                    // Store the education data for later use
                    window.editingEducation = response.education;
                    window.editingEducationId = educationId;

                    // Open edit education modal
                    const modal = new bootstrap.Modal(document.getElementById('editeducation'));
                    modal.show();
                }
            },
            error: (xhr) => {
                console.error('Error fetching education:', xhr);
                Swal.fire(
                    'Error!',
                    'Failed to load education data.',
                    'error'
                );
            }
        });
    }

    // Experience methods
    deleteExperience(e) {
        e.preventDefault();
        const experienceId = $(e.currentTarget).data('experience-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/user/profile/experience/${experienceId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        if (response.success) {
                            $(`[data-experience-id="${experienceId}"]`).fadeOut(300, function () {
                                $(this).remove();
                            });
                            Swal.fire(
                                'Deleted!',
                                'Experience record has been deleted.',
                                'success'
                            );
                        }
                    },
                    error: (xhr) => {
                        Swal.fire(
                            'Error!',
                            'Failed to delete experience record.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    editExperience(e) {
        e.preventDefault();
        const experienceId = $(e.currentTarget).data('experience-id');

        // Clear any previous editing data
        window.editingExperience = null;
        window.editingExperienceId = null;

        // Fetch experience data from backend
        $.ajax({
            url: `/user/profile/experience/${experienceId}`,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success) {
                    // Store the experience data for later use
                    window.editingExperience = response.experience;
                    window.editingExperienceId = experienceId;

                    // Open edit experience modal
                    const modal = new bootstrap.Modal(document.getElementById('editworkExperience'));
                    modal.show();
                }
            },
            error: (xhr) => {
                console.error('Error fetching experience:', xhr);
                Swal.fire(
                    'Error!',
                    'Failed to load experience data.',
                    'error'
                );
            }
        });
    }

    // Certificate methods
    deleteCertification(e) {
        e.preventDefault();
        const certificationId = $(e.currentTarget).data('certification-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/user/profile/certificate/${certificationId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        if (response.success) {
                            $(`[data-certification-id="${certificationId}"]`).fadeOut(300, function () {
                                $(this).remove();
                            });
                            Swal.fire(
                                'Deleted!',
                                'Certificate record has been deleted.',
                                'success'
                            );
                        }
                    },
                    error: (xhr) => {
                        Swal.fire(
                            'Error!',
                            'Failed to delete certificate record.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    editCertification(e) {
        e.preventDefault();
        const certificationId = $(e.currentTarget).data('certification-id');

        // Clear any previous editing data
        window.editingCertificate = null;
        window.editingCertificateId = null;

        // Fetch certificate data from backend
        $.ajax({
            url: `/user/profile/certificate/${certificationId}`,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success) {
                    // Store the certificate data for later use
                    window.editingCertificate = response.certificate;
                    window.editingCertificateId = certificationId;

                    // Open edit certification modal
                    const modal = new bootstrap.Modal(document.getElementById('editcertification'));
                    modal.show();
                }
            },
            error: (xhr) => {
                console.error('Error fetching certificate:', xhr);
                Swal.fire(
                    'Error!',
                    'Failed to load certificate data.',
                    'error'
                );
            }
        });
    }

    // Utility methods
    showAlert(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        // Remove existing alerts
        $('.alert').remove();

        // Add new alert at the top of the page
        $('.container').prepend(alertHtml);

        // Auto-hide after 5 seconds
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 5000);
    }

    // Form submission methods
    submitEducation(formData) {
        formData.currently_studying = formData.currently_studying === true || formData.currently_studying === 'true' || formData.currently_studying === 1;

        return $.ajax({
            url: '/user/profile/education',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    updateEducation(id, formData) {
        formData.currently_studying = formData.currently_studying === true || formData.currently_studying === 'true' || formData.currently_studying === 1;

        return $.ajax({
            url: `/user/profile/education/${id}`,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    submitExperience(formData) {
        formData.currently_working = formData.currently_working === true || formData.currently_working === 'true' || formData.currently_working === 1;

        return $.ajax({
            url: '/user/profile/experience',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    updateExperience(id, formData) {
        formData.currently_working = formData.currently_working === true || formData.currently_working === 'true' || formData.currently_working === 1;

        return $.ajax({
            url: `/user/profile/experience/${id}`,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    submitCertification(formData) {
        return $.ajax({
            url: '/user/profile/certificate',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    updateCertification(id, formData) {
        return $.ajax({
            url: `/user/profile/certificate/${id}`,
            type: 'PUT',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    // Add this method to your ProfileManager class in profile-management.js
    submitMultipleEducation(educationDataArray) {
        return $.ajax({
            url: '/user/profile/education/',
            type: 'POST',
            data: JSON.stringify({ educations: educationDataArray }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    // Similarly add for experience and certification
    submitMultipleExperience(experienceDataArray) {
        return $.ajax({
            url: '/user/profile/experience/',
            type: 'POST',
            data: JSON.stringify({ experiences: experienceDataArray }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    submitMultipleCertification(certificationDataArray) {
        return $.ajax({
            url: '/user/profile/certificate',
            type: 'POST',
            data: JSON.stringify({ certificates: certificationDataArray }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
}

// Initialize when document is ready
$(document).ready(function () {
    window.profileManager = new ProfileManager();
});