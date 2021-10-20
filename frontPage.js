let getUl = document.querySelector("ul"); 
		let getBody = document.querySelector("body");
		let result = document.documentElement.scrollTop;
		let getNavBar = document.getElementsByClassName("navBar");
		
		let getMiddleTextPic = document.getElementsByClassName("mp");
		let getMiddleText = document.getElementsByClassName("mt");
				

		function switchNavBarColor(){
			if(window.scrollY > 0){
				for(var nb of getNavBar){
					nb.style.backgroundColor = "#f1f1f1";
				}
			}else{
				for(var nb of getNavBar){
					nb.style.backgroundColor = "transparent";
				}
				getUl.style.backgroundColor = "transparent";
			}
		}
		
		window.onscroll = function(){getMiddleSection()}; 
		
		function getMiddleSection(){
			
			switchNavBarColor();

			for(var text of getMiddleText){
				if(window.scrollY > 570){
				text.className = "slideUp"; 
				}
			}
			for(var pic of getMiddleTextPic){
				if(window.scrollY > 400){
					pic.className = "slideUp"; 
				}
			}
		}		
		
		
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