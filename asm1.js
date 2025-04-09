document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        row.addEventListener('mouseover', () => {
            row.style.backgroundColor = '#f0f8ff';
        });
        row.addEventListener('mouseout', () => {
            row.style.backgroundColor = '';
        });
        row.addEventListener('click', () => {
            // Xóa lớp 'table-active' khỏi tất cả các hàng
            rows.forEach(r => r.classList.remove('table-active'));
            // Thêm lớp 'table-active' vào hàng được chọn
            row.classList.add('table-active');
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('table tbody tr');
    rows.forEach(row => {
        row.addEventListener('click', () => {
            // Xóa lớp 'table-active' khỏi tất cả các hàng
            rows.forEach(r => r.classList.remove('table-active'));
            // Thêm lớp 'table-active' vào hàng được chọn
            row.classList.add('table-active');
        });
    });
});