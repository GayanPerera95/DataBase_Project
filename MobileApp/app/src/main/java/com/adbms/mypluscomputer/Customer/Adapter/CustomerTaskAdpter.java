package com.adbms.mypluscomputer.Customer.Adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.recyclerview.widget.RecyclerView;

import com.adbms.mypluscomputer.Customer.Model.Task_Customer_Model;
import com.adbms.mypluscomputer.Employee.Adapter.TaskAdapter;
import com.adbms.mypluscomputer.Employee.Model.Task_Model;
import com.adbms.mypluscomputer.R;
import com.squareup.picasso.MemoryPolicy;
import com.squareup.picasso.NetworkPolicy;
import com.squareup.picasso.Picasso;

import java.util.List;

public class CustomerTaskAdpter  extends  RecyclerView.Adapter<CustomerTaskAdpter.MyViewHolder>{


    Context context;;
    List<Task_Customer_Model> taskCustomerModelList;

    public CustomerTaskAdpter(Context context, List<Task_Customer_Model> taskCustomerModelList) {
        this.context = context;
        this.taskCustomerModelList = taskCustomerModelList;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {


        View view ;
        LayoutInflater inflater = LayoutInflater.from(context);
        view = inflater.inflate( R.layout.cus_task_card,parent,false) ;
        final MyViewHolder viewHolder = new MyViewHolder(view) ;


        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {




        holder.problemText.setText(taskCustomerModelList.get(position).getProblem()+"");
//        holder.state.setText(task_modelList.get(position).getS()+"");
        holder.device_model.setText(taskCustomerModelList.get(position).getDevice_model()+"");
        holder.serial_number.setText(taskCustomerModelList.get(position).getSerial_number()+"");
        holder.customer_name.setText(taskCustomerModelList.get(position).getEmployee_name()+"");
        holder.date.setText(taskCustomerModelList.get(position).getReceived_date()+"");
        holder.state.setText(taskCustomerModelList.get(position).getP_Presant()+"%");


        holder.state_bar.setProgress((int) Double.parseDouble(String.valueOf(taskCustomerModelList.get(position).getP_Presant())));

        try {

            Picasso.get().load( taskCustomerModelList.get(position).getEmployee_Profile()+"" )
                    .networkPolicy( NetworkPolicy.NO_CACHE)
                    .memoryPolicy( MemoryPolicy.NO_CACHE,MemoryPolicy.NO_STORE)

                    .into( holder.customer_image );

        }catch (Exception e){

        }

        boolean isExpanded = taskCustomerModelList.get(position).isExpanded();
        holder.expandableLayout.setVisibility(isExpanded ? View.VISIBLE : View.GONE);
    }

    @Override
    public int getItemCount() {
        return taskCustomerModelList.size();
    }


    class   MyViewHolder extends  RecyclerView.ViewHolder {
        ConstraintLayout expandableLayout;
        TextView problemText;



        TextView state;
        TextView device_model;
        TextView serial_number;
        TextView customer_name;
        TextView date;


        ProgressBar state_bar;


        ImageView customer_image;
        public MyViewHolder(@NonNull View itemView) {
            super(itemView);

            expandableLayout = itemView.findViewById(R.id.expandableLayout);
            problemText = itemView.findViewById(R.id.problemText);
            state = itemView.findViewById(R.id.state);
            state_bar = itemView.findViewById(R.id.state_bar);
            device_model = itemView.findViewById(R.id.device_model);
            serial_number = itemView.findViewById(R.id.serial_number);
            customer_name = itemView.findViewById(R.id.customer_name);
            date = itemView.findViewById(R.id.date);
            customer_image = itemView.findViewById(R.id.customer_image);


            problemText.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {

                    Task_Customer_Model task_model=taskCustomerModelList.get(getAdapterPosition());
                    task_model.setExpanded(!task_model.isExpanded());
                    notifyItemChanged(getAdapterPosition());

                }
            });

        }
    }
}
