document.addEventListener('DOMContentLoaded', function() {
    const fetchButton = document.getElementById('fetchButton');
    const productList = document.getElementById('productList');
    const minimalPriceElement = document.getElementById('minimalPrice');
    const maximalPriceElement = document.getElementById('maximalPrice');
    const averagePriceElement = document.getElementById('averagePrice');

    const formatPrice = (price) => {
        const formatedPriceNum = Number(price).toFixed(2);
        
        return `${formatedPriceNum} $`;
    }

    const fetchProducts = (onLoad = '') => {
        productList.innerHTML = '';
        minimalPriceElement.innerHTML = '';
        maximalPriceElement.innerHTML = '';
        averagePriceElement.innerHTML = '';
        fetchButton.innerHTML = onLoad ? 'Fetch products' : 'Fetching...';

        fetch(`app/Controllers/Api/products.php${onLoad}`)
            .then(response => response.json())
            .then(data => {
                fetchButton.innerHTML = 'Fetch products';
                minimalPriceElement.innerHTML = formatPrice(data.productsPriceInfo.minimumPrice);
                maximalPriceElement.innerHTML = formatPrice(data.productsPriceInfo.maximumPrice);
                averagePriceElement.innerHTML = formatPrice(data.productsPriceInfo.averagePrice);
                console.log('data', data);

                data.products.forEach(product => {
                    const productItemRow = document.createElement('div');
                    const productParentItem = document.createElement('div');
                    productItemRow.className = 'productListRow';
                    productParentItem.textContent = `${product.id}: ${product.title}`;
                    productList.appendChild(productItemRow);
                    productItemRow.appendChild(productParentItem);

                    if (product.variants && product.variants.length) {
                        product.variants.forEach(children => {
                            const productChildrenItem = document.createElement('div');
                            productChildrenItem.className = 'productListRowChildren';
                            productChildrenItem.textContent = `${children.title}: ${children.price}$`;
                            productItemRow.appendChild(productChildrenItem);
                        });
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    }

    fetchProducts('?first'); // First products fetch on document load

    fetchButton.addEventListener('click', function() {
        fetchProducts();
    });
});