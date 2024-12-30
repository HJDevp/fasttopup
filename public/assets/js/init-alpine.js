function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  function no_scrool(){
    root       = document.querySelector('#root');
    no_scrool = root.classList.add('no_scroll');
    console.log("body", root);
    return no_scrool;
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
        if(this.isSideMenuOpen){
         no_scrool();
        }
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}


document.addEventListener('DOMContentLoaded', () => {
  // FAQS 
  let elements = document.querySelectorAll("[data-menu]");
  for (let i = 0; i < elements.length; i++) {
      let main = elements[i];
  
      main.addEventListener("click", function () {
          let element = main.parentElement.parentElement;
          let indicators = main.querySelectorAll("img");
          let child = element.querySelector("#menu");
          let h = element.querySelector("#mainHeading>div>p");
  
          h.classList.toggle("font-semibold");
          child.classList.toggle("hidden");
          // console.log(indicators[0]);
          indicators[0].classList.toggle("rotate-180");
      });
  }


 
  /*~~~~~~~~~~~~~~~ SHOW SCROLL UP ~~~~~~~~~~~~~~~*/
  const scrollUp = () => {
    let scrollUpBtn = document.getElementById('scroll-up');
    // console.log(this.scrollY, this.scrollX);
    if(this.scrollY >= 10){
       scrollUpBtn.classList.remove('bottom-4');
       scrollUpBtn.classList.add('bottom-0');
    }else{
       scrollUpBtn.classList.add('bottom-4');
       scrollUpBtn.classList.remove('bottom-0');
    }
  }
  
  window.addEventListener('scroll', scrollUp);


  /*~~~~~~~~~~~~~~~ SCROLL REVEAL ANIMATION ~~~~~~~~~~~~~~~*/

  const sr = ScrollReveal({
    origin      : "top",
    distance    : "60px",
    duration    : 2500,
    delay       : 300,
    reset       : true
  });

  const sr2 = ScrollReveal({
    origin      : "rigth",
    distance    : "80px",
    duration    : 2500,
    delay       : 300,
    reset       : true
  });
  
  // sr.reveal('.', {delay: 500, scale: 0.5});
  sr2.reveal('.banner_reveal, .allcards_reveal', {interval: 100});
  
  /*~~~~~~~~~~~~~~~ SWIPER ~~~~~~~~~~~~~~~*/
  const swiper = new Swiper('.swiper', {
     speed: 400,
     spaceBetween: 30,
     autoplay: {
        delay: 3000,
        disableOnInteraction: false,
     },
     // If we need pagination
     pagination: {
       el: '.swiper-pagination',
       clickable: true,
     },
     grabCursor: true,
  
     breakpoints: {
        640 : {
           slidesPerView: 1
        },
  
        748 : {
           slidesPerView: 2
        },
  
        1024 : {
           slidesPerView: 5
        },
     }
  });


  
      

  


});
