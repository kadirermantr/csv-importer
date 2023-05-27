<!doctype html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSV Importer</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="d-flex justify-content-center">
			<div class="card w-50 mt-5">
				<div class="card-header">
					<h3 class="text-center">CSV Importer</h3>
				</div>

				<div class="card-body">
					<form action="upload.php" method="POST" enctype="multipart/form-data">
						<div class="mb-3">
							<input type="text" class="form-control" name="campaign-name" id="campaign-name" placeholder="Campaign name" required />
						</div>
						<div class="mb-3">
							<select class="form-select" name="campaign-date" required>
								<option selected disabled value="">Select date</option>
								<option value="2023-01">January 2023</option>
								<option value="2023-02">February 2023</option>
								<option value="2023-03">March 2023</option>
							</select>
						</div>

						<div class="mb-3">
							<input class="form-control" type="file" accept=".csv" name="file" id="campaign-file" required />
						</div>

						<div class="mb-3">
							<button type="submit" class="btn btn-success w-100">Add</button>
						</div>
					</form>

					<?php if (isset($_GET['message'])) { ?>
						<div id="alert" class="alert alert-secondary">
							<?= $_GET['message'] ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

	<script type="text/javascript">
		setTimeout(function () {
			$('#alert').alert('close');
		}, 5000);
	</script>
</body>
</html>
