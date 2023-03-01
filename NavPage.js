  // Define an array of page names
  const pageNames = ['Description', 'Interview Logs', ];

  // Get the navigation list element
  const navList = document.getElementById('nav-list');

  // Loop through the page names and create a new list item for each one
  pageNames.forEach(pageName => {
    const li = document.createElement('li');
    const a = document.createElement('a');
    a.href = `${pageName.replace(/ /g, '-')}.html`;
    a.textContent = pageName;
    li.appendChild(a);
    navList.appendChild(li);
  });

  // Example function to add a new page to the navigation bar
  function addPage(pageName) {
    // Check if the page name is already in the navigation bar
    const existingPage = document.querySelector(`#nav-list a[href$="${pageName.replace(/ /g, '-')}.html"]`);
    if (existingPage) {
      console.error(`Page ${pageName} already exists in the navigation bar.`);
      return;
    }

    // Create a new list item for the page
    const li = document.createElement('li');
    const a = document.createElement('a');
    a.href = `${pageName.replace(/ /g, '-')}.html`;
    a.textContent = pageName;
    li.appendChild(a);
    navList.appendChild(li);
  }

  // Example function to remove a page from the navigation bar
  function removePage(pageName) {
    // Find the list item for the page and remove it
    const li = document.querySelector(`#nav-list a[href$="${pageName.replace(/ /g, '-')}.html"]`).parentElement;
    if (li) {
      li.remove();
    } else {
      console.error(`Page ${pageName} not found in the navigation bar.`);
    }
  }