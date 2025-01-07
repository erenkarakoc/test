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
            max: 50,
            message: 'Username must be between 8 and 50 characters'
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
          callback: {
            message: 'Please enter a valid phone number',
            callback: input => {
              if (input.value.trim()) {
                return libphonenumber.isValidNumber(input.value.trim());
              }
              return true;
            }
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

  const profileSaveButton = document.querySelector('#profileSaveButton');
  updateUserProfileForm.addEventListener('submit', async e => {
    e.preventDefault();

    const validationStatus = await fv.validate();

    if (validationStatus === 'Valid') {
      profileSaveButton.setAttribute('disabled', true);
      profileSaveButton.querySelector('span').innerHTML = profileSaveButton.getAttribute('data-loading-text');
      profileSaveButton.querySelector('svg').classList.remove('loading-hidden');

      const form = e.target;
      const formData = new FormData(form);
      const data = {
        username: formData.get('username'),
        full_name: formData.get('full_name'),
        country: formData.get('country'),
        phone_number: formData.get('phone_number'),
        date_of_birth: document.querySelector('#date_of_birth').value
      };

      const response = await postRequest('/user/update-user-profile', data);

      if (response.success) {
        setTimeout(() => {
          profileSaveButton.querySelector('span').innerHTML = profileSaveButton.getAttribute('data-text');
          profileSaveButton.querySelector('svg').classList.add('loading-hidden');
          profileSaveButton.removeAttribute('disabled');
          toastr.success('Profile updated.');
        }, 500);
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

  const dateOfBirth = document.querySelector('#date_of_birth');
  const clearDateOfBirth = document.querySelector('#clearDateOfBirth');
  dateOfBirth.addEventListener('input', e => {
    if (e.target.value) clearDateOfBirth.style.display = 'block';
  });
  clearDateOfBirth.addEventListener('click', () => {
    dateOfBirth.value = '';
    clearDateOfBirth.style.display = 'none';
  });

  document.querySelectorAll('.nav-link').forEach(navLink => {
    const target = navLink.getAttribute('data-bs-target');

    navLink.addEventListener('click', () => {
      const url = new URL(window.location);
      url.searchParams.set('tab', target.replace('#', ''));
      window.history.pushState({}, '', url);
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab')) {
      const manageTab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
      manageTab.show();
    }
  });

  const summaryItems = document.querySelectorAll('[data-summary-item-target]');

  summaryItems.forEach(summaryItem => {
    summaryItem.addEventListener('click', () => {
      const url = new URL(window.location);
      const target = summaryItem.getAttribute('data-summary-item-target');

      if (target === '2fa') {
        const tab = new bootstrap.Tab(document.querySelector("[data-bs-target='#security']"));
        tab.show();
        url.searchParams.set('tab', 'security');
        document.querySelector('.two-factor-authentication-form > div').filter = 'brightness';
        setTimeout(() => {
          document.querySelector('.two-factor-authentication-form > div').style.background = '';
        }, 1000);
      } else {
        const tab = new bootstrap.Tab(document.querySelector("[data-bs-target='#update-profile']"));
        tab.show();
        url.searchParams.set('tab', 'update-profile');
        document.querySelector('#' + target).focus();
      }
    });
  });
})();
