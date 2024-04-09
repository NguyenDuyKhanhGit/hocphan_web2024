<?php include_once 'header_admin.php'; ?>
<?php include_once 'sidebar_admin.php'; ?>
<?php include_once 'controller/category.php' ?>
<?php
$cat = new category();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$delcat = $cat->del_category($id);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Danh sách danh mục</h2>
		<div class="block">
			<?php
			if (isset($delcat)) {
				echo $delcat;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên danh mục</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_cate = $cat->show_category();
					if ($show_cate) {
						$i = 0;
						while ($result = $show_cate->fetch()) {
							$i++;


					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['catName']; ?></td>
								<td>
									<a href="catedit.php?catid=<?php echo $result['catId'] ?>">Edit</a>
									||
									<a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['catId'] ?>">Delete</a>
								</td>
							</tr>

					<?php
						}
					}
					?>

				</tbody>

			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include_once 'footer_admin.php'; ?>