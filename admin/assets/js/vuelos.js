class VuelosPaginator {
  constructor(options) {
    this.itemsPerPage = options.itemsPerPage || 6;
    this.containerSelector = options.containerSelector;
    this.paginationContainer = document.getElementById('pagination');
    this.container = document.querySelector(this.containerSelector);
    this.items = Array.from(this.container.querySelectorAll('.flight-card'));
    this.currentPage = 1;
    this.totalPages = Math.ceil(this.items.length / this.itemsPerPage);

    this.init();
  }

  init() {
    this.renderItems();
    this.renderPagination();
    this.addEventListeners();
  }

  renderItems() {
    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;

    // Ocultar/Mostrar las tarjetas según la página actual
    this.items.forEach((item, index) => {
      if (index >= startIndex && index < endIndex) {
        item.classList.remove('hidden');
      } else {
        item.classList.add('hidden');
      }
    });
  }

  renderPagination() {
    this.paginationContainer.innerHTML = '';

    // Botón Anterior
    this.addPaginationButton('«', this.currentPage > 1, () => this.goToPage(this.currentPage - 1));

    // Números de página
    for (let i = 1; i <= this.totalPages; i++) {
      this.addPaginationButton(i, true, () => this.goToPage(i), i === this.currentPage);
    }

    // Botón Siguiente
    this.addPaginationButton('»', this.currentPage < this.totalPages, () => this.goToPage(this.currentPage + 1));
  }

  addPaginationButton(text, enabled, onClick, isActive = false) {
    const li = document.createElement('li');
    const button = document.createElement('button');
    button.className = `pagination-button ${isActive ? 'active' : ''} ${!enabled ? 'disabled' : ''}`;
    button.textContent = text;

    if (enabled) {
      button.addEventListener('click', onClick);
    }

    li.appendChild(button);
    this.paginationContainer.appendChild(li);
  }

  goToPage(page) {
    if (page < 1 || page > this.totalPages) return;
    this.currentPage = page;
    this.renderItems();
    this.renderPagination();
  }

  addEventListeners() {
    // Aquí puedes agregar más event listeners si es necesario
  }
}

// Inicializar la paginación cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', function () {
  // Asegúrate de que existan elementos antes de inicializar la paginación
  const vuelosContainer = document.querySelector('.wrapp-vuelos');
  if (vuelosContainer && vuelosContainer.querySelectorAll('.flight-card').length > 0) {
    const paginator = new VuelosPaginator({
      itemsPerPage: 6, // Ajusta este número según necesites
      containerSelector: '.wrapp-vuelos'
    });
  }
});