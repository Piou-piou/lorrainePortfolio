import RibsCore from 'ribs-core';

class Ribsnav {
  constructor() {
    this.addEventListenerOpenButtons();
    this.addEventListenerCloseButtons();
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
    nav.classList.add('open');
  }

  /**
   * method to close nav and show button to reopen it
   * @param event
   */
  closeNav(event) {
    const button = event.currentTarget;
    const nav = RibsCore.parents(button, '.ribs-nav');
    const openButton = document.querySelector(`[data-nav="${nav.id}"]`);
    console.log(`[data-nav="${nav.id}"]`)
    openButton.classList.remove('hidden');
    nav.classList.remove('open');
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
}

const nav = new Ribsnav();