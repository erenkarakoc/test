/**
 * Team
 */

('use strict');

(function () {
  const inviteFriendsButton = document.querySelector('#inviteFriendsButton');
  const gdzReferFriends = document.querySelector('.gdz-refer-friends');
  const refLink = gdzReferFriends.querySelector('#ref-copy-input').value;
  let inviteFriendsButtonLocked = false;
  inviteFriendsButton.addEventListener('click', () => {
    navigator.share(refLink);

    return;

    inviteFriendsButtonLocked = true;
    gdzReferFriends.classList.add('animate');

    gdzReferFriends.scrollIntoView({ behaviour: 'smooth', block: 'center', inline: 'nearest' });
    setTimeout(() => {
      gdzReferFriends.classList.remove('animate');
      inviteFriendsButtonLocked = false;
    }, 3000);
  });
})();
