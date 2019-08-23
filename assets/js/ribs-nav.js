import RibsCore from 'ribs-core';

class Ribsnav {
  constructor() {
    this.addEventListenerOpenButtons();
    this.addEventListenerCloseButtons();
    this.addEventListenerWindowResize();
  }

  /**
   * method to open a nav based on clicked open icon
   * @param event
   */
  openNav(event) {
    const button = event.currentTarget;
    const dataNav = button.dataset.nav;
    const nav = document.getElementById(dataNav);
    button.classList.add('hidden');
    nav.style.display = 'block';
    setTimeout(() => nav.style.left = `0px`, 100);
  }

  /**
   * method to close nav and show button to reopen it
   * @param event
   */
  closeNav(event) {
    const button = event.currentTarget;
    const nav = RibsCore.parents(button, '.ribs-nav');
    const openButton = document.querySelector(`[data-nav="${nav.id}"]`);
    openButton.classList.remove('hidden');
    nav.style.left = `-${nav.dataset.leftPosition}px`;
    setTimeout(() => nav.style.display = 'none', 600);
  }

  /**
   * method to add events listener on all open nav icons
   */
  addEventListenerOpenButtons() {
    const buttons = document.getElementsByClassName('ribs-nav-open-icon');

    Array.from(buttons).forEach((element) => {
      element.addEventListener('click', this.openNav);
    });
  }

  /**
   * method to add events listener on all close nav icons
   */
  addEventListenerCloseButtons() {
    const buttons = document.getElementsByClassName('ribs-nav-close-icon');

    Array.from(buttons).forEach((element) => {
      element.addEventListener('click', this.closeNav);
    });
  }

  /**
   * method to define left position of nav to hide it on mobile
   * @param navs
   */
  definePosLeftMobileNav(navs) {
    Array.from(navs).forEach((element) => {
      if (!element.dataset.leftPosition) {
        element.dataset.leftPosition = RibsCore.getWidth(element);
      }
    });
  }

  /**
   * method to change display of nav if screen size change
   */
  addEventListenerWindowResize() {
    window.addEventListener('resize', () => {
      const width = document.documentElement.clientWidth;
      const navs = document.getElementsByClassName('ribs-nav');
      let display = 'block';
      if (width < 570) {
        display = 'none';
        this.definePosLeftMobileNav(navs);
      }

      Array.from(navs).forEach((element) => {
        if (element.style.display !== display) {
          element.style.display = display;
        }
      });
    });
  }
}

const nav = new Ribsnav();