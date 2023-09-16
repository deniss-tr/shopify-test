<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="app/assets/main.css" type="text/css">
	<title>Shopify test</title>
</head>
<body>
	<div class="wrapper">
        <div class="widget">
            <div class="widget-row">
                <div class="widget-row_title">
                    <span>Minimim price: </span>
                </div>
                <div class="widget-row_price">
                    <span id="minimalPrice"></span>
                </div>
            </div>
            <div class="widget-row">
                <div class="widget-row_title">
                    <span>Maximal price: </span>
                </div>
                <div class="widget-row_price">
                    <span id="maximalPrice"></span>
                </div>
            </div>
            <div class="widget-row">
                <div class="widget-row_title">
                    <span>Average price: </span>
                </div>
                <div class="widget-row_price">
                    <span id="averagePrice"></span>
                </div>
            </div>
        </div>
        <div class="actions">
            <button id="fetchButton">Fetch products</button>
        </div>
        <div id="productList"></div>
		
	</div>
    <script src="app/assets/script.js"></script>
</body>
</html>