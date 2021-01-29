package com.adbms.mypluscomputer.Employee;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import android.os.Bundle;
import android.util.Log;
import android.widget.SearchView;
import android.widget.Toast;

import com.adbms.mypluscomputer.API.RetroClient;
import com.adbms.mypluscomputer.Employee.Adapter.TaskAdapter;
import com.adbms.mypluscomputer.Employee.Model.Task_Model;
import com.adbms.mypluscomputer.R;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EmployeeActivity extends AppCompatActivity {


    private String currentUserId="100";


    List<Task_Model> task_modelList;

    RecyclerView recyclerView;
    SwipeRefreshLayout swipeRefreshLayout;

    SearchView search_bar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.employee_activity);

        recyclerView=findViewById(R.id.recyclerView);
        search_bar=findViewById(R.id.search_view);
        swipeRefreshLayout=(SwipeRefreshLayout) findViewById( R.id.swipeMenu );



        search_bar.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String s) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String s) {
                LoadData(s);
//               Toast.makeText(EmployeeActivity.this,s+"",
//                     Toast.LENGTH_SHORT).show();
                return false;
            }
        });

        LoadData("");

        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                LoadData("");

                swipeRefreshLayout.setRefreshing( false );
            }



        });
    }

    private void LoadData(String s) {

        task_modelList = new ArrayList<>();
        Map<String, String>  fileds = new HashMap<>();

        fileds.put("emp_id",currentUserId);
        fileds.put("search_text",s);


        Call<List<Task_Model>> getRepairDetails= RetroClient.getInstance().getApi().getRepairDetails(fileds);


        getRepairDetails.enqueue(new Callback<List<Task_Model>>() {
            @Override
            public void onResponse(Call<List<Task_Model>> call, Response<List<Task_Model>> response) {
                task_modelList =response.body();

                TaskAdapter adapter= new TaskAdapter(EmployeeActivity.this, task_modelList);
                recyclerView.setLayoutManager(new LinearLayoutManager(EmployeeActivity.this));
                recyclerView.setAdapter(adapter);

//                for(Task_Model task_models :task_models ){
//
//                    Log.e("Customer_Name",task_models.getCustomer_Name());
//                    Log.e("Customer_Name",task_models.getJob_id());
//
//                }

            }

            @Override
            public void onFailure(Call<List<Task_Model>> call, Throwable t) {
                Log.e("onFailure",t.getMessage());
            }
        });

    }
}