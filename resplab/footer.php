<footer class="footer">
			    <div class="container-fluid">
				   <div class="row">
				       <div class="col-md-6">
					       <nav class="d-flex">
						      <ul class="m-0 p-0">
							     <li><a href="#">Home</a></li>
								  <li><a href="#">company</a></li>
								   <li><a href="#">portfolio</a></li>
								    <li><a href="#">Blogs</a></li>
							  <ul>
						   </nav>
					   </div>					   
					   <div class="col-md-6">
					       <p class="copyright d-flex justify-content-end">
						      &copy 2023 Turma de TADS 3º semestre.&#160
							  <a href="https://www.einsteinlimeira.com.br/portal/public/">Faculdades Integradas Einstein de Limeira</a>
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


	  
<script type="text/javascript">	
	$(document).ready(function(){
		$("#sidebar-collapse").on('click',function(){
		$('#sidebar').toggleClass('active');
		$('#content').toggleClass('active');
		});
		
		$(".more-button,.body-overlay").on('click',function(){
			$('#sidebar,.body-overlay').toggleClass('show-nav');
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
	function successSoft(){
		alert("Software inserido com sucesso!!!");
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

  </body>
</html>