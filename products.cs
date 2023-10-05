using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Inventory_Management_System
{
    public partial class products : Sample2
    {
        int edit = 0; //this 0 is indication to save operation and 1 in an indication update operation
        int prodID;
        public products()
        {
            InitializeComponent();
        }

        retrival r = new retrival();
        private void products_Load(object sender, EventArgs e)
        {
            MainClass.disable_reset(leftpanel);
            r.getList("st_getCategorieslist", categoryDD, "Category", "ID");
        }

        public override void AddBtn_Click(object sender, EventArgs e)
        {
            MainClass.Enable_reset(leftpanel);
            edit = 0;
        }

        public override void EditBtn_Click(object sender, EventArgs e)
        {
            edit = 1;
            MainClass.Enable(leftpanel);
        }

        public override void SaveBtn_Click(object sender, EventArgs e) 
        {
                //---Name---
                if (producttxt.Text == "") { productErrorLabel.Visible = true; } else { productErrorLabel.Visible = false; }
                //---Barcode---
                if (barcodetxt.Text == "") { barcodeErrorLabel.Visible = true; } else { barcodeErrorLabel.Visible = false; }
                //---Expire date---
                if (ExpirePicker.Value < DateTime.Now) { expireErrorLabel.Visible = true; expireErrorLabel.Text = "Invalid Date"; }else { expireErrorLabel.Visible = false; }
                //---Again Expire date---
                if (ExpirePicker.Value.Date == DateTime.Now.Date) { expireErrorLabel.Visible = false; }
                //---Category--- (-1 blank) (0 select)
                if (categoryDD.SelectedIndex == -1) { categoryErrorLabel.Visible = true; } else { categoryErrorLabel.Visible = false; }


                //Error is the type of msg
                if (productErrorLabel.Visible || barcodeErrorLabel.Visible || expireErrorLabel.Visible || categoryErrorLabel.Visible || categoryErrorLabel.Visible)
                {
                    MainClass.ShowMSG("Fields With * are mandatory", "Stop", "Error");
                }
                else
                {
                    if (edit == 0) //Code for save operation
                    {

                        Insertion i = new Insertion();
                        //For expire date
                        if (ExpirePicker.Value.Date == DateTime.Now.Date)
                        {
                            i.InsertProduct(producttxt.Text, barcodetxt.Text, Convert.ToInt32(categoryDD.SelectedValue));
                        }
                        else
                        {
                            i.InsertProduct(producttxt.Text, barcodetxt.Text, Convert.ToInt32(categoryDD.SelectedValue), ExpirePicker.Value);

                        }

                       r.ShowProducts(dataGridView1, proIDGV, proNameGV, expireGV, barcodeGV, catIDGV, catGV);
                        MainClass.disable_reset(leftpanel);

                    }
                    else if (edit == 1) //Code for upate operation
                    {
                        DialogResult dr = MessageBox.Show("Are you sure, you want to update record?", "Question....", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                        if (dr == DialogResult.Yes)
                        {
                            Updation u = new Updation();
                            //for expire date update
                            if (ExpirePicker.Value.Date == DateTime.Now.Date)
                            {
                                u.updateProduct(prodID, producttxt.Text, barcodetxt.Text, Convert.ToInt32(categoryDD.SelectedValue));

                            }
                            else
                            {
                                u.updateProduct(prodID, producttxt.Text, barcodetxt.Text, Convert.ToInt32(categoryDD.SelectedValue), ExpirePicker.Value);

                            }
                           // u.updateProduct(prodID, producttxt.Text, barcodetxt.Text, Convert.ToInt32(categoryDD.SelectedValue), ExpirePicker.Value);
                            r.ShowProducts(dataGridView1, proIDGV, proNameGV, expireGV, catGV, barcodeGV, catIDGV);
                            MainClass.disable_reset(leftpanel);
                        }
                    }
                }
            }
        public override void DeleteBtn_Click(object sender, EventArgs e)
        {
            if (edit == 1)
            {
                DialogResult dr = MessageBox.Show("Are you sure, you want to delete record?", "Question....", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                if (dr == DialogResult.Yes)
                {
                    Deletion d = new Deletion();
                    d.Delete(prodID, "st_deleteproduct", "@proID");
                    r.ShowProducts(dataGridView1, proIDGV, proNameGV, expireGV, barcodeGV, catIDGV, catGV);
                }
            }
        }

        public override void Searchtxt_TextChanged(object sender, EventArgs e)
        {

        }

        public override void ViewBtn_Click(object sender, EventArgs e)
        {
            r.ShowProducts(dataGridView1, proIDGV, proNameGV, expireGV, catGV, barcodeGV, catIDGV);
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex != -1 && e.ColumnIndex!= -1)
            {
                edit = 1;
                DataGridViewRow row = dataGridView1.Rows[e.RowIndex];
                prodID = Convert.ToInt32(row.Cells["proIDGV"].Value.ToString());
                producttxt.Text = row.Cells["proNameGV"].Value.ToString();
                barcodetxt.Text = row.Cells["barcodeGV"].Value.ToString();
                if (row.Cells["expireGV"].FormattedValue.ToString() == "")
                {
                    ExpirePicker.Value = DateTime.Now;
                }
                else
                {
                    ExpirePicker.Value = Convert.ToDateTime(row.Cells["expireGV"].Value.ToString());

                }
                categoryDD.SelectedValue = row.Cells["catIDGV"].Value.ToString();
                MainClass.disable(leftpanel);
            }
        }
    }
}
