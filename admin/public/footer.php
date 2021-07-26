<?php

if(!defined('allow')) {
    header("HTTP/1.0 404 Not Found");
}

?>
            </div>

		</div>
		<!-- END wrapper -->

		<!-- Right bar overlay-->
		<div class="rightbar-overlay"></div>

		<!-- Vendor js -->
		<script src="assets/js/vendor.min.js"></script>

		<!-- App js -->
		<script src="assets/js/app.js"></script>
		<script src="assets/js/app.min.js"></script>
		<script src="assets/js/toast.js"></script>

		<?php if(@$db == true) { ?>
		<!-- third party js -->
		<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
		<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
		<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

		<!-- Tickets js -->
		<script src="assets/js/pages/tickets.js"></script>
		<?php } ?>
	
		<?php if(@$userdb == true) { ?>
		<!-- third party js -->
		<script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
		<script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
		<script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
		<script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>

		<!-- Tickets js -->
		<script src="assets/js/pages/user.js"></script>
		<?php } ?>

		<!-- App js -->
		<script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>
		<script src="assets/js/toast.js"></script>
	</body>
</html>