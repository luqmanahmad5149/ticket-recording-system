<?php

namespace App\Admin\Controllers;

use App\Models\Ticket;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TicketController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Tickets';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Ticket());

        $grid->column('id', __('Id'));
        $grid->column('date', __('Date'))->filter('range', 'date');
        $grid->column('cust_name', __('Customer Name'))->filter('like');
        $grid->column('unit_purchased', __('Unit Purchased'));
        $grid->column('currency', __('Currency'));
        $grid->column('unit_price')->display(function($e) {
            return  number_format((float) $e, 2, '.', '');
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Ticket::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('date', __('Date'));
        $show->field('cust_name', __('Customer Name'));
        $show->field('unit_purchased', __('Unit Purchased'));
        $show->field('currency', __('Currency'));
        $show->field('unit_price', __('Unit Price'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Ticket());

        $form->date('date', __('Date'))->rules('required');
        $form->text('cust_name', __('Customer Name'))->rules('required|min:3');
        $form->text('unit_purchased', __('Unit Purchased'))->rules('required|numeric');
        $form->text('currency', __('Currency'))->rules('required|min:3|max:3');
        $form->text('unit_price', __('Unit Price'))->rules('required|numeric');

        $form->saving(function (Form $form) {

            $form->unit_price = number_format((float) $form->unit_price, 2, '.', '');
        
        });

        return $form;
    }
}
