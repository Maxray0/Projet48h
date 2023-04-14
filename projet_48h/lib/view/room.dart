import 'package:flutter/material.dart';

class RoomCard extends StatelessWidget {
  final String name;

  const RoomCard({super.key, required this.name});

  @override
  Widget build(BuildContext context) {
    return Card(
      elevation: 5,
      child: ListTile(
        title: Text(name),
      ),
    );
  }
}
