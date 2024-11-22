document.addEventListener("DOMContentLoaded", (event) => {

  document.addEventListener('click', (ev) => {
    let modal = document.querySelector('.modal')
    document.querySelectorAll('.btn-close').forEach(e => {
      if(e === ev.target){
        modal.classList.remove('show');
        modal.classList.add('hidden');
      }
    });

    document.querySelectorAll('.js-btn-check').forEach(e => {
      if(e === ev.target) {
        modal.classList.add('show');
        modal.classList.remove('hidden');

        let id = e.dataset.value;
        document.querySelector('#reserva_id').value = id;
      }
    })
    
  })
});