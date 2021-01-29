package com.adbms.mypluscomputer;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import com.adbms.mypluscomputer.Customer.CustomerActivity;
import com.adbms.mypluscomputer.Employee.EmployeeActivity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    public void goToCustomerPage(View view) {

        startActivity(new Intent(MainActivity.this, CustomerActivity.class));
    }

    public void goToEmployeePage(View view) {
        startActivity(new Intent(MainActivity.this, EmployeeActivity.class));


    }
}