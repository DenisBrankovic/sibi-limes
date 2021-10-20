var getHamburgerContainer = document.getElementById("hamburgerContainer");
		var getCloseContainer = document.getElementById("closeContainer");
		var getMobMenu = document.getElementById("mobMenu");
		var getUlClosed = document.getElementsByClassName("ulClosed");
		var getMobMenuItem = document.getElementsByClassName("mobMenuItem");		 

		getCloseContainer.addEventListener("click", closeMobileMenu);
		getHamburgerContainer.addEventListener("click", openMobileMenu);

		function openMobileMenu(){
			getMobMenu.classList.remove("ulClosed");
			getMobMenu.classList.add("ulOpen");
			
			// for(var allItems of getMobMenuItem){
				// allItems.style.opacity = "1";
			// }			
		}

		function closeMobileMenu(){
			getMobMenu.classList.add("ulClosed");
			getMobMenu.classList.remove("ulOpen"); 
						
			for(var allItems of getMobMenuItem){
				allItems.style.opacity = "0"; 
			}
		}
		
		function showListItems(){
			for(var allItems of getMobMenuItem){
				allItems.style.opacity = "1";
			}
		}