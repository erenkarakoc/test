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

  const updateUserProfileForm = document.querySelector('#updateUserProfileForm');
  updateUserProfileForm.addEventListener('submit', async e => {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const data = {
      username: formData.get('username')
    };

    const response = await postRequest('/user/update-user-profile', data);

    if (response.success) {
      toastr.success('Profile updated.');
    }
  });
})();
