/**
 * Team
 */

('use strict');

(function () {
  const inviteFriendsButton = document.querySelector('#inviteFriendsButton');
  const gdzReferFriends = document.querySelector('.gdz-refer-friends');
  let inviteFriendsButtonLocked = false;
  inviteFriendsButton.addEventListener('click', () => {
    inviteFriendsButtonLocked = true;
    gdzReferFriends.classList.add('animate');

    gdzReferFriends.scrollIntoView({ behaviour: 'smooth', block: 'center', inline: 'nearest' });
    setTimeout(() => {
      gdzReferFriends.classList.remove('animate');
      inviteFriendsButtonLocked = false;
    }, 3000);
  });
})();
