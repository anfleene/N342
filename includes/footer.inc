<?php
    $current_file= str_replace(".php", "", preg_replace('/\?(.*)$/', "", basename($_SERVER['REQUEST_URI'], ".php")));
?>
		</div><!--WRAPPER-->
		<div clss="source">
      <p><a href="code_generator.php?file=<?= $current_file ?>">Page Source</a>
		</div>
	</body>
</html>
