/**
 * User Profile
 */

('use strict');

(function () {
  toastr.options = {
    positionClass: 'toast-top-center',
    timeOut: '1000',
    showDuration: '30',
    hideDuration: '30'
  };
  const updateUserProfileForm = document.querySelector('#updateUserProfileForm');

  const fv = FormValidation.formValidation(updateUserProfileForm, {
    fields: {
      username: {
        validators: {
          notEmpty: {
            message: 'Please enter a username'
          },
          stringLength: {
            min: 8,
            message: 'Username must be more than 8 characters'
          }
        }
      },
      full_name: {
        validators: {
          stringLength: {
            min: 3,
            max: 50,
            message: 'Full name must be between 3 and 50 characters'
          },
          regexp: {
            regexp: /^[a-zA-Z\s]+$/,
            message: 'Full name can only contain letters'
          }
        }
      },
      country: {
        validators: {}
      },
      phone_number: {
        validators: {
          regexp: {
            regexp: /^\+?[0-9\s]{7,20}$/,
            message: 'Please enter a valid phone number'
          }
        }
      },
      date_of_birth: {
        validators: {
          date: {
            format: 'YYYY-MM-DD',
            message: 'Please enter a valid date in YYYY-MM-DD format'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.update-profile-info-row'
      }),
      autoFocus: new FormValidation.plugins.AutoFocus()
    },
    init: instance => {
      instance.on('plugins.message.placed', function (e) {
        if (e.element.parentElement.classList.contains('input-group')) {
          e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
        }
      });
    }
  });

  const postRequest = async (url, data) => {
    const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken()
      },
      body: JSON.stringify(data)
    });

    return response.json();
  };

  updateUserProfileForm.addEventListener('submit', async e => {
    e.preventDefault();

    const validationStatus = await fv.validate();

    if (validationStatus === 'Valid') {
      const form = e.target;
      const formData = new FormData(form);
      const data = {
        username: formData.get('username')
      };

      const response = await postRequest('/user/update-user-profile', data);

      if (response.success) {
        toastr.success('Profile updated.');
      }
    } else {
      toastr.error('Please correct the errors before submitting.');
    }
  });

  document.addEventListener('click', e => {
    const button = e.target.closest('.copy-recovery-code');
    if (button) {
      const input = button.closest('.input-group').querySelector('.form-control');
      navigator.clipboard.writeText(input.value.trim()).then(() => {
        input.select();
      });
    }
  });
})();
