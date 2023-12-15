
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../Assets/js/materialize.js"></script>

  <!-- Inicialização do MaterializeCSS -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      M.AutoInit();
    });
  </script>


  <!-- Inicialização do Modal -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.modal');
      var instances = M.Modal.init(elems, {});
    });

    // Inicialização do Dropdown
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(elems, {});
    });

    // Inicialização do Form Select
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems, {});
    });
  </script>