(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all-submissions');
    const selectAllHeader = document.getElementById('select-all-header');
    const deselectAllButton = document.getElementById('deselect-all-submissions');
    const deleteSelectedButton = document.getElementById('delete-selected-submissions');
    const submissionCheckboxes = document.querySelectorAll('.submission-checkbox');

    const copyShortcodeButtons = document.querySelectorAll('.copy-shortcode-btn');
    copyShortcodeButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const shortcode = this.getAttribute('data-shortcode');

        navigator.clipboard
          .writeText(shortcode)
          .then(function () {
            button.classList.add('copied');

            setTimeout(function () {
              button.classList.remove('copied');
            }, 2000);
          })
          .catch(function (err) {
            console.error('Failed to copy shortcode:', err);

            const textarea = document.createElement('textarea');
            textarea.value = shortcode;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            button.classList.add('copied');
            setTimeout(function () {
              button.classList.remove('copied');
            }, 2000);
          });
      });
    });

    if (selectAllCheckbox) {
      selectAllCheckbox.addEventListener('change', function () {
        submissionCheckboxes.forEach(function (checkbox) {
          checkbox.checked = selectAllCheckbox.checked;
        });
      });
    }

    if (selectAllHeader) {
      selectAllHeader.addEventListener('change', function () {
        submissionCheckboxes.forEach(function (checkbox) {
          checkbox.checked = selectAllHeader.checked;
        });
      });
    }

    if (deselectAllButton) {
      deselectAllButton.addEventListener('click', function () {
        submissionCheckboxes.forEach(function (checkbox) {
          checkbox.checked = false;
        });
        if (selectAllCheckbox) selectAllCheckbox.checked = false;
        if (selectAllHeader) selectAllHeader.checked = false;
      });
    }

    if (deleteSelectedButton) {
      deleteSelectedButton.addEventListener('click', function () {
        const selectedIds = [];
        submissionCheckboxes.forEach(function (checkbox) {
          if (checkbox.checked) {
            selectedIds.push(checkbox.value);
          }
        });

        if (selectedIds.length === 0) {
          alert('Please select at least one submission to delete');
          return;
        }

        if (!confirm('Are you sure you want to delete ' + selectedIds.length + ' submission(s)?')) {
          return;
        }

        const formData = new FormData();
        formData.append('action', 'delete_multiple_submissions');
        formData.append('nonce', window.contactForm.admin_nonce);
        formData.append('submission_ids', JSON.stringify(selectedIds));

        fetch(window.contactForm.ajax_url, {
          method: 'POST',
          body: formData,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (data) {
            if (data.success) {
              selectedIds.forEach(function (id) {
                const row = document.querySelector('tr[data-id="' + id + '"]');
                if (row) {
                  row.remove();
                }
              });
              alert(data.data.message);
              location.reload();
            } else {
              alert(data.data.message);
            }
          })
          .catch(function (error) {
            console.error('Error:', error);
            alert('An error occurred while deleting submissions');
          });
      });
    }

    const viewButtons = document.querySelectorAll('.view-submission');
    viewButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const submissionId = this.getAttribute('data-id');
        const formId = this.getAttribute('data-form-id');
        const modal = document.getElementById('submission-modal-' + formId);
        const modalBody = modal.querySelector('.modal-body');

        const formData = new FormData();
        formData.append('action', 'get_submission_details');
        formData.append('nonce', window.contactForm.admin_nonce);
        formData.append('submission_id', submissionId);

        fetch(window.contactForm.ajax_url, {
          method: 'POST',
          body: formData,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (data) {
            if (data.success) {
              const submission = data.data.submission;
              const formDataObj = JSON.parse(submission.form_data);
              let html = '';

              html += '<div class="submission-detail">';
              html += '<strong>Submission ID:</strong> ';
              html += '<span class="submission-detail-value">' + 'Submission ' + submission.id + '</span>';
              html += '</div>';

              html += '<div class="submission-detail">';
              html += '<strong>Date:</strong> ';
              html += '<span class="submission-detail-value">' + submission.created_at + '</span>';
              html += '</div>';

              html += '<div class="submission-detail">';
              html += '<strong>IP Address:</strong> ';
              html += '<span class="submission-detail-value">' + submission.ip_address + '</span>';
              html += '</div>';

              html += '<div class="submission-detail">';
              html += '<strong>User Agent:</strong> ';
              html += '<span class="submission-detail-value">' + submission.user_agent + '</span>';
              html += '</div>';

              html += '<hr>';
              html += '<h3>Form Data:</h3>';

              for (const key in formDataObj) {
                let value = formDataObj[key];
                if (Array.isArray(value)) {
                  value = value.join(', ');
                }
                html += '<div class="submission-detail">';
                html += '<strong class="submission-detail-key">' + key + ':</strong> ';
                html += '<span class="submission-detail-value">' + value + '</span>';
                html += '</div>';
              }

              modalBody.innerHTML = html;
              modal.style.display = 'block';
              modal.setAttribute('data-submission-id', submissionId);
            } else {
              alert(data.data.message);
            }
          })
          .catch(function (error) {
            console.error('Error:', error);
            alert('An error occurred while loading submission details');
          });
      });
    });

    const closeModalButtons = document.querySelectorAll('.close-modal, .close-modal-btn');
    closeModalButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const modal = this.closest('.submission-modal');
        modal.style.display = 'none';
      });
    });

    const deleteModalButtons = document.querySelectorAll('.delete-submission-modal');
    deleteModalButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const modal = this.closest('.submission-modal');
        const submissionId = modal.getAttribute('data-submission-id');

        if (!confirm('Are you sure you want to delete this submission?')) {
          return;
        }

        const formData = new FormData();
        formData.append('action', 'delete_submission');
        formData.append('nonce', window.contactForm.admin_nonce);
        formData.append('submission_id', submissionId);

        fetch(window.contactForm.ajax_url, {
          method: 'POST',
          body: formData,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (data) {
            if (data.success) {
              modal.style.display = 'none';
              const row = document.querySelector('tr[data-id="' + submissionId + '"]');
              if (row) {
                row.remove();
              }
              alert(data.data.message);
              location.reload();
            } else {
              alert(data.data.message);
            }
          })
          .catch(function (error) {
            console.error('Error:', error);
            alert('An error occurred while deleting the submission');
          });
      });
    });

    window.addEventListener('click', function (event) {
      const modals = document.querySelectorAll('.submission-modal');
      modals.forEach(function (modal) {
        if (event.target === modal) {
          modal.style.display = 'none';
        }
      });
    });
  });
})();
