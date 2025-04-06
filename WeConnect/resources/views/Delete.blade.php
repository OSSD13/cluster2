<script>
    function confirmDelete() {
      Swal.fire({
        icon: 'error',
        title: 'ลบรายการนี้หรือไม่',
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#22c55e',   // เขียว
        cancelButtonColor: '#9ca3af',    // เทา
        customClass: {
          title: 'text-red-500 text-lg'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // แสดงแจ้งเตือนว่าลบเรียบร้อย
          Swal.fire({
            icon: 'success',
            title: 'ข้อมูลของคุณถูกลบแล้ว',
            confirmButtonText: 'กลับหน้าหลัก',
            confirmButtonColor: '#0ea5e9',
          }).then(() => {
            // กลับหน้าหลักหรือรีโหลดก็ได้
            window.location.href = 'index.html'; // เปลี่ยนตามที่ต้องการ
          });
        }
      });
    }
  </script>