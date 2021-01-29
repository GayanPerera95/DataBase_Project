package com.adbms.mypluscomputer;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageView;

public class SplashAcitivity extends AppCompatActivity {
    ImageView img;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.splash_acitivity);


        img=findViewById( R.id.image );
        Animation myanim= AnimationUtils.loadAnimation( this,R.anim.mytransition );
        img.startAnimation(myanim);



        Thread timer= new Thread(){
            public void run(){
                try{
                    sleep( 2000 );
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
                finally {
                    //enter here navigation actiovity to start using intent
                    startActivity(new Intent(SplashAcitivity.this,MainActivity.class));
                }
            }
        };
        timer.start();

    }
}