function data() {

    function getThemeFromLocalStorage() {
      // For now, we do not support dark mode
      return false;

      // // if user already changed the theme, use it
      // if (window.localStorage.getItem('dark')) {
      //   return JSON.parse(window.localStorage.getItem('dark'))
      // }
      //
      // // else return their preferences
      // return (
      //   !!window.matchMedia &&
      //   window.matchMedia('(prefers-color-scheme: dark)').matches
      // )
    }

    function setThemeToLocalStorage(value) {
      window.localStorage.setItem('dark', value)
    }

    return {
      dark: getThemeFromLocalStorage(),
      toggleTheme() {
        this.dark = !this.dark
        setThemeToLocalStorage(this.dark)
      },
      toggleShowVideo() {
        this.videoIsOpen = !this.videoIsOpen
      },
      videoIsOpen: false,
      isSideMenuOpen: false,
      toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen
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
document.addEventListener('alpine:init', () => {
  Alpine.store('config', {
    apiUrl: undefined,
    init() {
      let xhr = new XMLHttpRequest();
      xhr.open('GET', '/config.blade.php', true);
      xhr.responseType = 'json';
      xhr.onload = function () {
        let status = xhr.status;
        if (status === 200) {
          Alpine.store('config').setApiUrl(xhr.response.api_url);
          document.dispatchEvent(new CustomEvent('config:init'));
        } else {
          console.error(status, xhr.response);
          Alpine.store('config').setApiUrl('error_from_config');
        }
      };
      xhr.send()
    },
    getApiUrl() {
      return this.apiUrl
    },
    setApiUrl(url) {
      console.log('setApiUrl ' + url);
      this.apiUrl = url
    }
  })

})