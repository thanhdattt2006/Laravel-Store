<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashBoard');
    }

    // Slider
    public function addSlider() {
        return view('admin/managementAll/addSlider');
    }

    public function allSlider() {
        return view('admin/managementAll/allSlider');
    }

    // Products
    public function addProducts() {
        return view('admin/managementAll/addProducts');
    }

    public function allProducts() {
        return view('admin/managementAll/allProducts');
    }

    //Categories
    public function addCategories(){
        return view('admin/managementAll/addCategories');
    }

    public function allCategories(){
        return view('admin/managementAll/allCategories');
    }

    //Orders
    public function managementOrder(){
        return view('admin/managementAll/managementOrder');
    }

    //Customers
    public function customers(){
        return view('admin/managementAll/customers');
    }

}
?>