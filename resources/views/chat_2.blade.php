<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Web của Kim Tùng</title>
</head>
<body>

<!--todo: Nơi chứa danh sách tin chat-->
<div id="list"></div>
<!---->

<!--todo: Form chat-->
<label>ID của tôi: <span id="my-id">Lỗi kết nối</span></label>
<form>
  <label>Tên</label>
  <br>
  <input id="name">
  <br>
  <label>Nội dung</label>
  <br>
  <input id="content">
  <br>
  <label>ID người nhận</label>
  <br>
  <input id="friend-id" value="id1"><input type="button" id="connect" value="Kết nối">
  <br>
  <input type="button" id="send" value="Gửi">
</form>
<!---->

<!--todo: import thư viện-->
<script type="text/javascript" src="{{Asset('/assets/peer.min.js') }}"></script>
<!---->
<script>
  var peer = new Peer('id2', {host: '27.79.160.66', port: 9000, path: '/'}); // Thay key đi các bác nhé
  var conn = null; // biến conn để thực hiện các thao tác như gửi và nhận dữ liệu

  // Sự kiện chờ kết nối đến máy chủ
  peer.on('open', function(id) {
    // Sau khi đã kết nối đến máy chủ thì show "ID của tôi" ra
    document.getElementById('my-id').textContent = id;

    // Sau khi click nút kết nối sẽ gửi 1 yêu cầu kết nối đến ID người nhận
    document.getElementById('connect').onclick = function() {
      conn = peer.connect(document.getElementById('friend-id').value);

      // Lắng nghe chat sau khi đã kết nối trong vai trò người gửi yêu cầu trò chuyện
      listen();
    };
  });

  // Sự kiện chờ có người kết nối tới mình
  peer.on('connection', function(connL) {
    conn = connL;

    // Sau khi nhận kết nối sẽ đặt value cho "ID nhười nhận" và 1 thông báo
    document.getElementById('friend-id').value = connL.peer;
    alert(connL.peer + ' vừa kết nối, sẵn sàng chat');

    // Lắng nghe chat sau khi đã kết nối trong vai trò người chấp nhận trò chuyện
    listen();
  });

  // Sự kiện khi nhấn nút gửi
  document.getElementById('send').onclick = function() {
    if(conn===null) {
      alert('Vui lòng kết nối đến 1 người');
    } else {

      // Nếu đã kết nối ta tiến hành gửi 1 đoạn JSON đến bạn chat của ta gồm:
      // {
      //   name: 'Tên',
      //   content: 'Nội dung'
      // }
      var smsJson = {
        name:    document.getElementById('name').value,
        content: document.getElementById('content').value
      };
      conn.send(smsJson);

      // Hiển thị ra màn hình tin nhắn ta vừa gửi
      showMessage(smsJson);

      // Reset nội dung trong input content
      document.getElementById('content').value = '';
    }
  };

  // Hàm lắng nghe tin nhắn từ bạn chat và show nó ra
  function listen() {
    if(conn!==null) {

      // Sự kiện lắng nghe khi có tin nhắn mới
      conn.on('data', function(smsJson) {

        // Hiển thị ra màn hình tin nhắn ta vừa nhận
        showMessage(smsJson);
      });
    }
  }

  // Hàm hiển thị tin nhắn ra màn hình
  function showMessage(smsJson) {
    var list       = document.getElementById('list');
    list.innerHTML = list.innerHTML + '<div>' + smsJson.name + ': ' + smsJson.content + '</div>';
  }
</script>
</body>
</html>