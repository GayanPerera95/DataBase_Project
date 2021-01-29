package com.adbms.mypluscomputer.Employee.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

import com.adbms.mypluscomputer.API.RetroClient;
import com.adbms.mypluscomputer.Employee.Model.Server_Response;
import com.adbms.mypluscomputer.Employee.Model.Task_Model;
import com.adbms.mypluscomputer.R;
import com.squareup.picasso.MemoryPolicy;
import com.squareup.picasso.NetworkPolicy;
import com.squareup.picasso.Picasso;

import java.util.HashMap;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class TaskAdapter extends  RecyclerView.Adapter<TaskAdapter.MyViewHolder>{
    Context context;;
    List<Task_Model> task_modelList;


    String current_userId="100";

    public TaskAdapter(Context context, List<Task_Model> task_modelList) {
        this.context = context;
        this.task_modelList = task_modelList;
    }




    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view ;
        LayoutInflater inflater = LayoutInflater.from(context);
        view = inflater.inflate( R.layout.emp_task_card,parent,false) ;
        final MyViewHolder viewHolder = new MyViewHolder(view) ;

        viewHolder.updatebtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

//
               // Toast.makeText(context,"Update Failed !",Toast.LENGTH_SHORT).show();

                HashMap<String, String> fileds = new HashMap<>();
                fileds.put("job_id",task_modelList.get(viewHolder.getAdapterPosition()).getJob_id());
                fileds.put("emp_id",current_userId);
                fileds.put("Presentage",viewHolder.prcentage.getText().toString());
                Call<Server_Response> updateRepairDetails= RetroClient.getInstance().getApi().updateRepairDetails(fileds);


                updateRepairDetails.enqueue(new Callback<Server_Response>() {
                    @Override
                    public void onResponse(Call<Server_Response> call, Response<Server_Response> response) {
                        if(response.body().getSuccess().equals("true")){


                            Toast.makeText(context,"Update Success !",Toast.LENGTH_SHORT).show();
                            //successAlert();

                            //alertComponents.successAlert();
                        }else{
                            Toast.makeText(context,"Update Failed !",Toast.LENGTH_SHORT).show();
                            //errorAlert();
                            // alertComponents.errorAlert();
                        }

                    }

                    @Override
                    public void onFailure(Call<Server_Response> call, Throwable t) {
                        Toast.makeText(context,"Update Failed !",Toast.LENGTH_SHORT).show();

                    }
                });
            }
        });

        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {


        holder.problemText.setText(task_modelList.get(position).getProblem()+"");
//        holder.state.setText(task_modelList.get(position).getS()+"");
        holder.device_model.setText(task_modelList.get(position).getDevice_model()+"");
        holder.serial_number.setText(task_modelList.get(position).getSerial_number()+"");
        holder.customer_name.setText(task_modelList.get(position).getCustomer_Name()+"");
        holder.date.setText(task_modelList.get(position).getReceived_date()+"");
        holder.prcentage.setText(task_modelList.get(position).getP_Presant()+"");
        holder.state.setText(task_modelList.get(position).getP_Presant()+"%");


        try {

            Picasso.get().load( task_modelList.get(position).getCustomer_Profile()+"" )
                    .networkPolicy( NetworkPolicy.NO_CACHE)
                    .memoryPolicy( MemoryPolicy.NO_CACHE,MemoryPolicy.NO_STORE)

                    .into( holder.customer_image );

        }catch (Exception e){

        }

        holder.state_bar.setProgress((int) Double.parseDouble(String.valueOf(task_modelList.get(position).getP_Presant())));

        boolean isExpanded = task_modelList.get(position).isExpanded();
        holder.expandableLayout.setVisibility(isExpanded ? View.VISIBLE : View.GONE);
    }

    @Override
    public int getItemCount() {
        return task_modelList.size();
    }


    class   MyViewHolder extends  RecyclerView.ViewHolder{

        ConstraintLayout expandableLayout;
        ConstraintLayout container;


        TextView problemText;
        TextView state;
        TextView device_model;
        TextView serial_number;
        TextView customer_name;
        TextView date;


        ProgressBar state_bar;


        ImageView customer_image;

        EditText prcentage;


        Button updatebtn;
         public MyViewHolder(@NonNull View itemView) {
             super(itemView);
             expandableLayout = itemView.findViewById(R.id.expandableLayout);
             container = itemView.findViewById(R.id.container);
             problemText = itemView.findViewById(R.id.problemText);
             state = itemView.findViewById(R.id.state);
             state_bar = itemView.findViewById(R.id.state_bar);
             device_model = itemView.findViewById(R.id.device_model);
             serial_number = itemView.findViewById(R.id.serial_number);
             customer_name = itemView.findViewById(R.id.customer_name);
             date = itemView.findViewById(R.id.date);
             customer_image = itemView.findViewById(R.id.customer_image);
             prcentage = itemView.findViewById(R.id.prcentage);
             updatebtn = itemView.findViewById(R.id.updatebtn);


//             updatebtn.setOnClickListener(new View.OnClickListener() {
//                 @Override
//                 public void onClick(View v) {
//                     Toast.makeText(context,"Update Failed !",Toast.LENGTH_SHORT).show();
//
//                 }
//             });

             problemText.setOnClickListener(new View.OnClickListener() {
                 @Override
                 public void onClick(View v) {

                     Task_Model task_model=task_modelList.get(getAdapterPosition());
                     task_model.setExpanded(!task_model.isExpanded());
                     notifyItemChanged(getAdapterPosition());

                 }
             });


         }

    }
}
