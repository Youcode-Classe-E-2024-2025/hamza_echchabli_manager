
const usersAccountsBtn = document.getElementById('users-accounts-btn');
const newAccountsBtn = document.getElementById('new-accounts-btn');
const archivedAccountsBtn = document.getElementById('archived-accounts-btn');

const usersAccountsSection = document.getElementById('users-accounts');
const newAccountsSection = document.getElementById('new-accounts');
const archivedAccountsSection = document.getElementById('archived-accounts');

usersAccountsBtn.addEventListener('click', () => {
    showSection(usersAccountsSection);
});

newAccountsBtn.addEventListener('click', () => {
    showSection(newAccountsSection);
});

archivedAccountsBtn.addEventListener('click', () => {
    showSection(archivedAccountsSection);
});

function showSection(section) {
    usersAccountsSection.classList.add('hidden-section');
    newAccountsSection.classList.add('hidden-section');
    archivedAccountsSection.classList.add('hidden-section');

    section.classList.remove('hidden-section');
}