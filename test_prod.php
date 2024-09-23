<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Selection with Radio Values</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .product {
            margin-bottom: 10px;
        }
        .radio-group {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>เลือกผลิตภัณฑ์และเลือกค่า Value</h1>

    <div id="productContainer">
        <div class="product">
            <label for="product1">ผลิตภัณฑ์:</label>
            <select id="product1" name="product1">
                <option value="productA">Product A</option>
                <option value="productB">Product B</option>
                <option value="productC">Product C</option>
            </select>
            <div class="radio-group">
                <label>Value:</label>
                <label><input type="radio" name="value1" value="value1-1"> 1</label>
                <label><input type="radio" name="value1" value="value1-2"> 2</label>
                <label><input type="radio" name="value1" value="value1-3"> 3</label>
            </div>
        </div>
    </div>

    <button onclick="addProduct()">เพิ่มผลิตภัณฑ์</button>

    <script>
        let productCount = 1;

        function addProduct() {
            productCount++;
            const productContainer = document.getElementById('productContainer');
            const newProduct = document.createElement('div');
            newProduct.classList.add('product');
            newProduct.innerHTML = `
                <label for="product${productCount}">ผลิตภัณฑ์:</label>
                <select id="product${productCount}" name="product${productCount}">
                    <option value="productA">Product A</option>
                    <option value="productB">Product B</option>
                    <option value="productC">Product C</option>
                </select>
                <div class="radio-group">
                    <label>Value:</label>
                    <label><input type="radio" name="value${productCount}" value="value${productCount}-1"> 1</label>
                    <label><input type="radio" name="value${productCount}" value="value${productCount}-2"> 2</label>
                    <label><input type="radio" name="value${productCount}" value="value${productCount}-3"> 3</label>
                </div>
            `;
            productContainer.appendChild(newProduct);
        }
    </script>
</body>
</html>
