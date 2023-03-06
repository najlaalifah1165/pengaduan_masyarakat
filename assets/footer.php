<!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="assets/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/dist/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="assets/node_modules/raphael/raphael-min.js"></script>
    <script src="assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--c3 JavaScript -->
    <script src="assets/node_modules/d3/d3.min.js"></script>
    <script src="assets/node_modules/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="assets/dist/js/dashboard1.js"></script>

    <!-- ====================== -->
    <?php @session_start();
    if (!empty($_SESSION['username'])) { ?>
     <!-- DataTables  & Plugins -->
     <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
     <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
     <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
     <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
     <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
     <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
     <script src="assets/plugins/jszip/jszip.min.js"></script>
     <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
     <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
     <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
     <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
     <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
     <script>
         $(function() {
             $("#dataTablesNya").DataTable({
                 "responsive": true,
                 "lengthChange": false,
                 "autoWidth": false,
                 "buttons": ["excel", "pdf", "print"]
             }).buttons().container().appendTo('#dataTablesNya_wrapper .col-md-6:eq(0)');
             $('#example2').DataTable({
                 "paging": true,
                 "lengthChange": false,
                 "searching": false,
                 "ordering": true,
                 "info": true,
                 "autoWidth": false,
                 "responsive": true,
             });
         });
     </script>
 <?php } ?>