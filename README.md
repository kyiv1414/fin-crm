<h1>About</h1>
<h4>Test for HR Partner.</h4>

Easy seed db with tinker commands:

 Client::factory()->count(10)->create();
 
 Employee::factory()->count(10)->create();
 
 Order::factory()->count(10)->create();
 
***
available routes:

1) api/incomes

2) api/expenses

3) api/profits

4) employee/salary/{employee_id}

* for 1), 2), 3) required "from" and "to" parameters

TO DO
 - add "from" and "to' request validation
 
