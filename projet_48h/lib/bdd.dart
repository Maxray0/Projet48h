import 'package:dart_mysql/dart_mysql.dart';

Future<MySqlConnection> getConnection() async {
  final settings = ConnectionSettings(
    host: 'localhost',
    port: 80,
    user: 'root',
    password: '',
    db: 'projet48h',
  );
  final conn = await MySqlConnection.connect(settings);
  return conn;
}

Future<List<String>> getName(MySqlConnection conn) async {
  List<String> names = [];

  final results = await conn.query('SELECT * FROM room');

  for (var row in results) {
    names.add(row['Name']);
  }

  return names;
}
