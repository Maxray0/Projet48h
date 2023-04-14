import 'package:flutter/material.dart';
import 'package:projet_48h/bdd.dart';
import 'package:projet_48h/view/room.dart';
import 'package:dart_mysql/dart_mysql.dart';

class DateInput extends StatefulWidget {
  const DateInput({Key? key}) : super(key: key);

  @override
  _DateInputState createState() => _DateInputState();
}

class _DateInputState extends State<DateInput> {
  DateTime dateTime = DateTime.now();
  bool hasChanged = false;

  Future<DateTime?> pickDate() => showDatePicker(
        context: context,
        initialDate: dateTime,
        firstDate: dateTime,
        lastDate: dateTime.add(const Duration(days: 30)),
      );

  Future<TimeOfDay?> pickTime() => showTimePicker(
        context: context,
        initialTime: TimeOfDay(hour: dateTime.hour, minute: dateTime.minute),
      );

  Future pickDateTime() async {
    DateTime? date = await pickDate();
    if (date == null) return;

    TimeOfDay? time = await pickTime();
    if (time == null) return;

    final dateTime =
        DateTime(date.year, date.month, date.day, time.hour, time.minute);

    setState(() {
      this.dateTime = dateTime;
      hasChanged = true;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: ListView(
          // crossAxisAlignment: CrossAxisAlignment.center,
          // mainAxisAlignment: MainAxisAlignment.center,
          children: [
            InkWell(
              onTap: () async {
                pickDateTime();
              },
              child: Container(
                decoration: BoxDecoration(
                  boxShadow: [
                    BoxShadow(
                      color: Colors.grey.withOpacity(0.5),
                      spreadRadius: 2,
                      blurRadius: 5,
                      offset: const Offset(0, 3),
                    ),
                  ],
                  borderRadius: BorderRadius.circular(10),
                  color: Colors.white,
                ),
                padding: const EdgeInsets.all(16),
                child: Row(
                  children: [
                    Text('${dateTime.day}/${dateTime.month}/${dateTime.year}'),
                    const SizedBox(width: 10),
                    Text('${dateTime.hour}:${dateTime.minute}'),
                    const Spacer(),
                    const Icon(Icons.calendar_month),
                  ],
                ),
              ),
            ),
            if (hasChanged)
              FutureBuilder<MySqlConnection>(
                future: getConnection(),
                builder: (context, snapshot1) {
                  if (snapshot1.connectionState == ConnectionState.done &&
                      snapshot1.hasData) {
                    return FutureBuilder<List<String>>(
                      future: getName(snapshot1.data!),
                      builder: (context, snapshot2) {
                        if (snapshot2.connectionState == ConnectionState.done) {
                          return ListView.builder(
                              itemCount: snapshot2.data!.length,
                              itemBuilder: (BuildContext context, int index) {
                                return RoomCard(name: snapshot2.data![index]);
                              });
                        } else if (snapshot2.connectionState ==
                            ConnectionState.waiting) {
                          return const CircularProgressIndicator();
                        } else {
                          return Text('Erreur : ${snapshot2.error}');
                        }
                      },
                    );
                  } else if (snapshot1.connectionState ==
                      ConnectionState.waiting) {
                    return const CircularProgressIndicator();
                  } else {
                    return Text('Erreur : ${snapshot1.error}');
                  }
                },
              ),
          ]),
    );
  }
}
