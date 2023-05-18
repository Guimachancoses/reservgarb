<footer class="footer">
			    <div class="container-fluid">
				   <div class="row">
				       <div class="col-md-6">
					       <nav class="d-flex">
						      <ul class="m-0 p-0">
							     <li><a href="#">Home</a></li>
								  <li><a href="https://www.garbuio.com.br/" target="blank">Empresa</a></li>
								   <li><a href="https://garbuio.tomticket.com" target="blank">atendimento</a></li>
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

	  
<script type="text/javascript">
	$(document).ready(function() {
		$("#sidebar-collapse").on('mouseenter', function() {
			$('#sidebar').addClass('active');
			$('#content').addClass('active');
		});
	$(document).ready(function() {
		$("#sidebar").on('mouseleave', function() {
			$('#sidebar').removeClass('active');
			$('#content').removeClass('active');
		});
	// $(".sidebar-header").on('click', function() {
	// 		$('#sidebar').toggleClass('active');
	// 		$('#content').toggleClass('active');
	// 	});

	$(".more-button,.body-overlay").on('click',function(){
			$('#sidebar,.body-overlay').toggleClass('show-nav');
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

});

</script>


<script type = "text/javascript">
	$(document).ready(function(){
		$("#table").DataTable();
	});
</script>

<script type = "text/javascript">
$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
});
</script>

<script type = "text/javascript">
	function confirmationDelete(anchor){
		var conf = confirm("Você tem certeza que deseja excluir??");
		if(conf){
			window.location = anchor.attr("href");
		}
	} 
</script>

<script>
	function success(){
		alert("Usuário inserido com sucesso!!!");
	}		
</script>

<script>
	function editsuccess(){
		alert("As alterações de usuário, foram feitas com sucesso!!!");
	}
</script>

<script>
	function addroom(){
		alert("Laboratório inserido com sucesso!!!");
	}		
</script>

<script>
$(document).ready(function() {
  $('#add-software-button').click(function() {
    $('#add-software-dialog').dialog('open');
  });

  $('#add-software-dialog').dialog({
    autoOpen: false,
    width: 400,
    buttons: {
      "Salvar": function() {
        // Aqui você pode adicionar o código para salvar o software
        $(this).dialog('close');
      },
      "Cancelar": function() {
        $(this).dialog('close');
      }
    }
  });
});

</script>


  </body>
</html>