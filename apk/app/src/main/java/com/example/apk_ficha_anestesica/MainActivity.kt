package com.example.apk_ficha_anestesica

import android.annotation.SuppressLint
import android.app.Activity
import android.net.http.SslError
import android.os.Bundle
import android.webkit.SslErrorHandler
import android.webkit.WebView
import android.webkit.WebViewClient
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.appcompat.app.AppCompatActivity
import com.example.apk_ficha_anestesica.databinding.ActivityMainBinding
import java.util.jar.Manifest


class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding

    @SuppressLint("SetJavaScriptEnabled")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        val webView = binding.webView
        webView.webViewClient = WebViewClient()
        webView.loadUrl("http://189.127.6.26:63050/inspecao_sesmt")
        //webView.loadUrl("http://10.200.0.50:8080/ficha_anestesica")


        webView.settings.javaScriptEnabled = true
        webView.settings.domStorageEnabled = true
        webView.settings.databaseEnabled = true
        webView.settings.allowFileAccess = true
        webView.settings.allowContentAccess = true
        webView.settings.mediaPlaybackRequiresUserGesture = false

        //setContentView(R.layout.activity_main)

        val requestCamera=registerForActivityResult(ActivityResultContracts.RequestPermission(),{
            if(it){
                Toast.makeText(applicationContext,"Camera Liberada", Toast.LENGTH_SHORT).show()
            }else{
                //Toast.makeText(applicationContext,"Permission not granted", Toast.LENGTH_SHORT).show()
            }
        })

        val requestStorage=registerForActivityResult(ActivityResultContracts.RequestPermission(),{
            if(it){
                Toast.makeText(applicationContext,"Arquivos Liberados", Toast.LENGTH_SHORT).show()
            }else{
                //Toast.makeText(applicationContext,"Permission not granted", Toast.LENGTH_SHORT).show()
            }
        })

        requestCamera.launch(android.Manifest.permission.CAMERA)
        requestStorage.launch(android.Manifest.permission.READ_EXTERNAL_STORAGE)


        //requestCamera.launch(android.Manifest.permission.READ_EXTERNAL_STORAGE)

    }
}