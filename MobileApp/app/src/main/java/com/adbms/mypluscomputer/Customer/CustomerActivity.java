package com.adbms.mypluscomputer.Customer;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.os.Bundle;
import android.widget.SearchView;
import android.widget.Toast;

import com.adbms.mypluscomputer.API.RetroClient;
import com.adbms.mypluscomputer.Customer.Adapter.CustomerTaskAdpter;
import com.adbms.mypluscomputer.Customer.Model.Task_Customer_Model;
import com.adbms.mypluscomputer.Employee.EmployeeActivity;
import com.adbms.mypluscomputer.Employee.Model.Task_Model;
import com.adbms.mypluscomputer.R;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class CustomerActivity extends AppCompatActivity {


    SearchView search_view;

    RecyclerView recyclerView;

    String currentUserId="10027052";

List<Task_Customer_Model> taskCustomerModelList;

    SwipeRefreshLayout swipeRefreshLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.customer_activity);

        search_view=findViewById(R.id.search_view);
        recyclerView=findViewById(R.id.recyclerView);
        swipeRefreshLayout=(SwipeRefreshLayout) findViewById( R.id.swipeMenu );

        search_view.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String s) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String s) {
                LoadData(s);
//                Toast.makeText(CustomerActivity.this,s+"",
//                        Toast.LENGTH_SHORT).show();
                return false;
            }
        });


        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                LoadData("");

                swipeRefreshLayout.setRefreshing( false );
            }



        });
        LoadData("");

    }

    private void LoadData(String s) {
        taskCustomerModelList= new ArrayList<>();

        Map<String, String> fileds = new HashMap<>();

        fileds.put("customer_id",currentUserId);
        fileds.put("search_text",s);

        Call<List<Task_Customer_Model>> getRepairCustomerDetails= RetroClient.getInstance().getApi().getRepairCustomerDetails(fileds);


        getRepairCustomerDetails.enqueue(new Callback<List<Task_Customer_Model>>() {
            @Override
            public void onResponse(Call<List<Task_Customer_Model>> call, Response<List<Task_Customer_Model>> response) {

                taskCustomerModelList=response.body();

                CustomerTaskAdpter customerTaskAdpter= new CustomerTaskAdpter(CustomerActivity.this,taskCustomerModelList);


                recyclerView.setLayoutManager(new LinearLayoutManager(CustomerActivity.this));

                recyclerView.setAdapter(customerTaskAdpter);
            }

            @Override
            public void onFailure(Call<List<Task_Customer_Model>> call, Throwable t) {

            }
        });


    }
}