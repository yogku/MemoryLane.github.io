const profileNav = document.querySelector('.profile-nav');
const profileIcon = document.querySelector('.profileIcon');

let isProfileNavActive = false;
let isHovering = false;

profileNav.style.display = 'none'; // Hide the profile-nav initially

profileIcon.addEventListener('click', () => {
  isProfileNavActive = true;

  setTimeout(() => {
    isProfileNavActive = false;
  }, 400); // Set profile-nav inactive after 400ms

  if (profileNav.style.display === 'none') {
    profileNav.style.display = 'block'; // Show the profile-nav when clicked
  } else {
    profileNav.style.display = 'none'; // Hide the profile-nav when clicked again
  }
});


//-------------------------------------------------------
// Post-nav
//-------------------------------------------------------

const postIcon = document.getElementById('postIcon');
const postNav = document.querySelector('.post-nav');

postIcon.addEventListener('mouseenter', function() {
  if (!isProfileNavActive) {
    isHovering = true;
    postNav.style.opacity = '1';
  }
});

postIcon.addEventListener('mouseleave', function() {
  if (!isProfileNavActive) {
    isHovering = false;
    setTimeout(function() {
      if (!isHovering && !isProfileNavActive) {
        postNav.style.opacity = '0';
      }
    }, 200); // Delay to allow time to move mouse from icon to nav
  }
});

postNav.addEventListener('mouseenter', function() {
  if (!isProfileNavActive) {
    isHovering = true;
  }
});

postNav.addEventListener('mouseleave', function() {
  if (!isProfileNavActive) {
    isHovering = false;
    setTimeout(function() {
      if (!isHovering && !isProfileNavActive) {
        postNav.style.opacity = '0';
      }
    }, 20); // Delay to allow time to move mouse from nav to icon
  }
});

// Hide profile-nav when clicking outside of profile-nav
document.addEventListener('click', (event) => {
  if (!isProfileNavActive && !profileNav.contains(event.target)) {
    profileNav.style.display = 'none';
  }
});

//------------------------------------------------------------------
// store name of user
//------------------------------------------------------------------
const inputUsername = document.getElementById('input-username');
const setNewUsernameButton = document.querySelector('.set-new-username');
const userText = document.querySelector('.profile-nav p b');

// Check for stored username in cookies
const storedUsername = getCookie('username');
if (storedUsername) {
  // If username is stored, set the text to the stored username
  userText.textContent = storedUsername;
  // Set the input value to the stored username
  inputUsername.value = storedUsername;
} else {
  // If no username is stored, set the text to "User"
  userText.textContent = 'User';
}

setNewUsernameButton.addEventListener('click', () => {
  const newUsername = inputUsername.value.trim();

  if (newUsername) {
    // Update the text with the new username
    userText.textContent = newUsername;

    // Save the new username to cookies
    setCookie('username', newUsername, 365); // 365 days expiration for cookie
  } else {
    // If input is empty, leave the text as "User"
    userText.textContent = 'User';

    // Remove the username cookie
    deleteCookie('username');
  }
});

// Function to get a cookie value by name
function getCookie(name) {
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith(name + '=')) {
      return cookie.substring(name.length + 1);
    }
  }
  return '';
}

// Function to set a cookie
function setCookie(name, value, days) {
  const expirationDate = new Date();
  expirationDate.setDate(expirationDate.getDate() + days);
  const cookieString = `${name}=${value}; expires=${expirationDate.toUTCString()}; path=/`;
  document.cookie = cookieString;
}

// Function to delete a cookie
function deleteCookie(name) {
  document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}

