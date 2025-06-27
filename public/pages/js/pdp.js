function getDataByWindowUrlKey() {
  let windowUrl = $(location).attr('href');
  let windowUrlKey = windowUrl.replace(/\/\s*$/, "").split('/').pop();
  let url = baseUrl + '/api/book/' + windowUrlKey;

  axios.get(url, {}, apiHeaders)
    .then(function (response) {
      let product = response.data.data;
      console.log('[DATA] response..', product);
      let template = '';

      $('.product-img-main-href').attr('href', product.cover);
      $('.product-img-main-src').attr('src', product.cover);
      $('#product-name').html(product.title);
      $('#product-price').html('IDR ' + parseFloat(product.price).toLocaleString());
      $('#product-description').html(product.description);
      $('#product-author').html(product.author);
      $('#product-publisher').html('First published ' + product.publication_year + ' by ' + product.publisher);

      // START -- note, unless you have these data in a database structure, here we are hardcoding them for display purposes
      // review
      let stars = randomIntFromInterval(1, 5);
      template = '';
      for (let index = 0; index < 5; index++) {
        template += `<i class="${index < stars ? 'yellow' : ''} icon_star"></i>`;
      }
      $('#product-review-stars').html(template);
      $('#product-review-body-count').html(randomIntFromInterval(1, 1000) + ' customer review');

      // status stock
      let statusStock = randomIntFromInterval(0, 1);
      $('#product-status-stock').addClass(statusStock ? 'in-stock' : 'out-of-stock');
      $('#product-status-stock').html(statusStock ?
        '<p>Available: <span>In stock</span></p>' :
        '<p>Available: <span>Out of stock</span></p>');
      if (!statusStock) {
        $('.product-add-to-cart').hide();
        $('.product-add-to-cart-is-disabled').show();
      }

      // tag
      let collectionOfTag = ['Painting','Oil Based', 'Pencils', 'Landscapes', 'Romanticism', 'Impressionism', 'Cubism', 'Surrealism',
        'Expressionism', 'Contemporary', 'Pointilism', 'Dadaism', 'Fauvism', 'Neoclasisicism', 'Baroque', 'Manerism', 'Rennaisance',
        'Portraits'];
      let selectedTags = collectionOfTag.sort(() => .5 - Math.random()).slice(0, 4); // only get 4, randomly
      template = '';
      for (let index = 0; index < selectedTags.length; index++) {
        template += `<a href="#">${selectedTags[index]}${(index == selectedTags.length - 1) ? '' : ', '}</a>`;
      }
      $('#product-tags').html(template);
      // END ----
    })

    .catch(function (error) {
      console.log('[ERROR] response..', error.code);
      if (error.code == "ERR_BAD_REQUEST") {
        Swal.fire({
          position: "top-end",
          icon: "warning",
          title: "False",
          html: "Produk yang Anda cari tidak ditemukan",
          showConfirmButton: false,
          timer: 5000
        });
      } else {
        Swal.fire({
          icon: 'error',
          width: 600,
          title: "Error",
          html: error.message,
          confirmButtonText: 'Ya',
        });
      }
    });
}

$(function () {
  getDataByWindowUrlKey();
});
