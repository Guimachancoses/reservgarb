<footer class="footer">
			    <div class="container-fluid">
				   <div class="row">
				       <div class="col-md-6">
					       <nav class="d-flex">
						      <ul class="m-0 p-0">
							     <li><a href="#">Home</a></li>
								  <li><a href="https://www.garbuio.com.br/" target="blank">Empresa</a></li>
								    <li><a href="https://www.garbuio.com.br/contato/" target="blank">contato</a></li>
							  <ul>
						   </nav>
					   </div>					   
					   <div class="col-md-6">
					       <p class="copyright d-flex justify-content-end">
						      &copy &#160<a style="color:white" href="https://www.linkedin.com/in/guilherme-machancoses-772986233/" target="blank"> GuiMac </a>&#160 &#10084;&#65039; 2023							  	                         		
						   </p>
					   </div>
				   </div>
				</div>
			 
			 </footer>
		</div>
</div>



<!----------html code compleate----------->
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.3.1.slim.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<!-- jquery and JS for table -->
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/dataTables.bootstrap.js"></script>
	<script src="../js/jquery.dataTables.js"></script>
	<script src="../js/script-calender.js"></script>
	<script src="../js/verif_cookie.js"></script>
	<script src="../js/validateCpf.js"></script>
	<script src="../js/validateForm.js"></script>
	<script src="../js/validatePwd.js"></script>
	<script src="../js/alerts.js"></script>
	<script src="../js/eyesPwd.js"></script>

	<!-- Função para automatizar sidebar	 -->
	<script type="text/javascript">
		
		$(document).ready(function() {

			$('#sidebar').addClass('active');
			$('#content').addClass('active');

			$("#sidebar-collapse").on('mouseleave', function() {
				$('#sidebar').addClass('active');
				$('#content').addClass('active');
			});

			$("#sidebar").on('mouseenter', function() {
				$('#sidebar').removeClass('active');
				$('#content').removeClass('active');
			});

			$("#sidebar-collapse").on('click',function(){
				$('#sidebar').toggleClass('active');
				$('#content').toggleClass('active');
			});

			$(".more-button,.body-overlay").on('click',function(){
					$('#sidebar,.body-overlay').toggleClass('show-nav');
			});

			// Função para abrir menu e fechar no touch do dispositivo móvel
			var touchStartX = 0;
			var touchMoveX = 0;
			var minSwipeDistance = 250;
			var sidebarWidth = $('#sidebar').outerWidth();

			$(document).on('touchstart', function(event) {
			touchStartX = event.originalEvent.touches[0].clientX;
			});

			$(document).on('touchmove', function(event) {
			touchMoveX = event.originalEvent.touches[0].clientX;
			});

			$(document).on('touchend', function(event) {
			var swipeDistance = touchMoveX - touchStartX;

			// Verificar se o gesto ocorreu de dentro para fora da área do elemento #sidebar
			if (swipeDistance > minSwipeDistance && touchStartX <= sidebarWidth && touchMoveX > touchStartX) {
				event.preventDefault(); // Impedir que o navegador feche
				$('#sidebar, .body-overlay').addClass('show-nav');
			} else if (swipeDistance < -minSwipeDistance) {
				$('#sidebar, .body-overlay').removeClass('show-nav');
			}

			touchStartX = 0; // Resetar os valores
			touchMoveX = 0;
			});


			// Retrair a barra lateral ao clicar fora dela
			$(document).on('click', function(event) {
				var sidebar = $('#sidebar');
				var sidebarCollapse = $('#sidebar-collapse');
				if (!sidebar.is(event.target) && sidebar.has(event.target).length === 0 && !sidebarCollapse.is(event.target)) {
					if (sidebarCollapse.hasClass('active')) {
						sidebar.removeClass('active');
						$('#content').removeClass('active');
					} else {
						sidebar.addClass('active');
						$('#content').addClass('active');
					}
				}
			});
		});
		
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.dropdown.keep-open').on({
			"shown.bs.dropdown": function() {
				$(this).data('closable', false);
			},
			"click": function() {
				$(this).data('closable', true);
			},
			"hide.bs.dropdown": function() {
				return $(this).data('closable');
			}
			});

			// Fechar o submenu quando clicar fora dele
			$(document).on('click', function(e) {
      		var target = $(e.target);
     		var isDropdownToggle = target.hasClass('.dropdown-toggle');
      		var isOpenSubmenu = target.next('.collapse.show');
      		var isSubmenu = target.hasClass('collapse');

			if (!isDropdownToggle && !isSubmenu && isOpenSubmenu) {
				$('.collapse.show').removeClass('show');
			}
			});

			// Fechar o submenu ao clicar em outro menu com ID diferente
			$('.dropdown-toggle').on('click', function() {
			var submenu = $(this).next('.collapse');
			var openSubmenus = $('.collapse.show');

			if (submenu.length && submenu[0] !== openSubmenus[0]) {
				openSubmenus.removeClass('show');
			}
			});
		});
	</script>


	<!-- Função para mensagem de exclusão -->
	<script type = "text/javascript">
		function confirmationDelete(anchor){
			var conf = confirm("Você tem certeza que deseja excluir??");
			if(conf){
				window.location = anchor.attr("href");
			}
		} 
	</script>

	<!-- Função para mensagem de exclusão de banco de dados para usuários-->
	<script type = "text/javascript">
		function confirmationDeletedb(anchor){
			var conf = confirm("( ATENÇÃO ) Essa ação apagará todos dados desse usuário.\n\nVocê tem certeza que deseja excluir, permanentemente??");
			if(conf){
				window.location = anchor.attr("href");
			}
		} 
	</script>

	<!-- Função para mensagem de exclusão de banco de dados para laboratorios-->
	<script type = "text/javascript">
		function confirmationDeletedbl(anchor){
			var conf = confirm("( ATENÇÃO ) Essa ação apagará todos dados desse laboratório.\n\nVocê tem certeza que deseja excluir, permanentemente??");
			if(conf){
				window.location = anchor.attr("href");
			}
		} 
	</script>

	<!-- Função para mensagem de liberar evento -->
	<script type = "text/javascript">
		function confirmationCheckin(anchor){
			var conf = confirm("Você tem certeza que deseja liberar essa locação?");
			if(conf){
				window.location = anchor.attr("href");
			}
		}
	</script>

<!-- Seu JavaScript -->
<!-- Adicione um script para lidar com o clique no botão -->
<script>
$(document).ready(function() {
  // Quando o botão for clicado
  $('#ligthbtn').on('click', function() {
    // Seleciona o elemento com a classe .main-content
    var mainContent = $('.main-content');
    // Seleciona o elemento com a classe .card
    var card = $('.card');

	// Seleciona o elemento com a classe .card
    var cardHeader = $('.card-header');

	// Seleciona o elemento com a classe .card
    var fooTer = $('.footer');

    // Alterna a classe para .main-content
    mainContent.toggleClass('dark-mode').css('background-color', mainContent.hasClass('dark-mode') ? 'black' : '');
    // Alterna a classe para .card
    card.toggleClass('dark-mode');
	// Alterna a classe para .card-header
    cardHeader.toggleClass('dark-mode');
	// Alterna a classe para .footer
    fooTer.toggleClass('dark-mode');
  });
});
</script>



  </body>
</html>