<!-- https://github.com/sparksuite/simple-html-receipt-template/blob/master/receipt.html -->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>A simple, clean, and responsive HTML receipt template</title>

		<style>
			.receipt-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.receipt-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.receipt-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.receipt-box table tr td:nth-child(2) {
				text-align: right;
			}

			.receipt-box table tr.top table td {
				padding-bottom: 20px;
			}

			.receipt-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.receipt-box table tr.information table td {
				padding-bottom: 40px;
			}

			.receipt-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.receipt-box table tr.details td {
				padding-bottom: 20px;
			}

			.receipt-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.receipt-box table tr.item.last td {
				border-bottom: none;
			}

			.receipt-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.receipt-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.receipt-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.rtl table {
				text-align: right;
			}

			.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="receipt-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img src="https://www.sparksuite.com/images/logo.png" style="width: 100%; max-width: 200px" />
								</td>

								<td style="font-size: 0.8rem">
									Receipt #: {{$data['receipt_number']}}<br />
									Created: {{$data['receipt_date']}}<br />
									Due: {{$data['receipt_due_date']}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									{{$data['nama_owner']}}<br />
									{{$data['ic_owner']}}<br />
									{{$data['email_owner']}}<br />
									{{$data['phone_owner']}}
								</td>

								<td>
									{{$data['nama_tenant']}}<br />
									{{$data['ic_tenant']}}<br />
									{{$data['email_tenant']}}<br />
									{{$data['phone_tenant']}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				{{-- <tr class="heading">
					<td>Payment Method</td>

					<td>Check #</td>
				</tr>

				<tr class="details">
					<td>Check</td>

					<td>1000</td>
				</tr> --}}

				<tr class="heading">
					<td>Item</td>

					<td>Price (RM)</td>
				</tr>

				<tr class="item last">
					<td>{{$data['item_type']}}</td>

					<td>{{$data['item_price']}}</td>
				</tr>

				<tr class="total">
					<td></td>

					<td>{{$data['item_price']}}</td>
				</tr>
			</table>
		</div>
	</body>
</html>