document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
});
document.addEventListener('keydown', function(event) {
    // ป้องกัน Ctrl+S (Save) และ Ctrl+P (Print)
    if (event.ctrlKey && (event.key === 's' || event.key === 'p')) {
      event.preventDefault();
    }
    // ป้องกัน Ctrl+C (Copy) และ Ctrl+U (View Source)
    if (event.ctrlKey && (event.key === 'c' || event.key === 'u')) {
      event.preventDefault();
    }
});
document.addEventListener('keydown', function(event) {
    // ตรวจสอบว่าปุ่มที่กดคือ F12 หรือไม่
    // event.key === 'F12' เป็นวิธีที่ทันสมัย
    // event.keyCode === 123 เป็นวิธีเก่า แต่ยังใช้ได้กับทุกเบราว์เซอร์
    if (event.key === 'F12' || event.keyCode === 123) {
      event.preventDefault();
    }
});