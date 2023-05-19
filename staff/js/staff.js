    // JavaScript code for function
    function toggleSidebar() {
        var sidebar = document.getElementsByClassName("sidebar");
        if (sidebar.style.display === "0%") {
          sidebar.style.width = "20%";
        } else {
          sidebar.style.display = "0%";
        }
      }
  
      // Switch between inventory and account settings pages
      var inventoryTab = document.getElementById("inventory");
      var carsSoldTab = document.getElementById("cars-sold");
      var custFinAppsTab = document.getElementById("cust-fin-apps");
      var custDocsTab = document.getElementById("cust-docs");
  
      function showInventory() {
        inventoryTab.style.display = "block";
        carsSoldTab.style.display = "none";
        custFinAppsTab.style.display = "none";
        custDocsTab.style.display = "none";
      }
  
      function showCarsSold() {
        inventoryTab.style.display = "none";
        carsSoldTab.style.display = "block";
        custFinAppsTab.style.display = "none";
        custDocsTab.style.display = "none";
      }
  
      function showCustFinApps() {
        inventoryTab.style.display = "none";
        carsSoldTab.style.display = "none";
        custFinAppsTab.style.display = "block";
        custDocsTab.style.display = "none";
      }
  
  
      // Set the initial active tab
      showCustFinApps();
  
      // Add click event listeners to the sidebar links
      document.querySelector(".sidebar a:nth-child(1)").addEventListener("click", showCustFinApps);
      document.querySelector(".sidebar a:nth-child(2)").addEventListener("click", showInventory);
  
      function confirmLogout() {
        var confirmed = confirm("Are you sure you want to logout?");
        if (confirmed) {
          window.location.href = "php/staffLogout.php?state=logout";
          exit();
        }
      }
  
      const toggleSidebarBtn = document.getElementById('toggle-sidebar');
      const sidebar = document.querySelector('.sidebar');
  
      toggleSidebarBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
      });