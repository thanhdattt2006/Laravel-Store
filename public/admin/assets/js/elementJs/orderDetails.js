
  document.querySelectorAll('.qty-input').forEach(input => {
    input.addEventListener('input', function () {
      const row = this.closest('tr');
      const price = parseInt(row.getAttribute('data-price'));
      const qty = parseInt(this.value) || 1;

      // Cập nhật total price
      const total = price * qty;
      row.querySelector('.total-price').textContent = formatVND(total);
    });
  });

  // Xử lý xóa dòng
  document.querySelectorAll('.delete').forEach(btn => {
    btn.addEventListener('click', function () {
      const row = this.closest('tr');
      row.remove();
    });
  });

  // Hàm định dạng VND
  function formatVND(value) {
    return value.toLocaleString('vi-VN');
  }
