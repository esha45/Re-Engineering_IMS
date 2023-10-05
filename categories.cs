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
    public partial class categories : Sample2
    {
        int edit = 0; //this 0 is indication to save operation and 1 in an indication update operation
        int catID;
        short stat;
        retrival r = new retrival();
        public categories()
        {
            InitializeComponent();
        }

        private void categories_Load(object sender, EventArgs e)
        {
            MainClass.disable(leftpanel);
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
            //---Category Name---
            if (categorytxt.Text == "") { categoryErrorLabel.Visible = true; }
            else { categoryErrorLabel.Visible = false; }
            //---IsActive---
            if (activeDD.SelectedIndex == -1) { activeErrorLabel.Visible = true; }
            else { activeErrorLabel.Visible = false; }


            //Error is the type of msg
            if (categoryErrorLabel.Visible || activeErrorLabel.Visible)
            {
                MainClass.ShowMSG("Fields With * are mandatory", "Stop", "Error");
            }
            else
            {

                if (activeDD.SelectedIndex == 0)
                {
                    stat = 1;
                }
                else if (activeDD.SelectedIndex == 1)
                {
                    stat = 0;
                }
                if (edit == 0) //Code for save operation
                {

                    Insertion i = new Insertion();

                    i.InsertCategory(categorytxt.Text, stat);
                    r.ShowCategories(dataGridView1, catIDGV, NameGV,StatusGV);
                    MainClass.disable_reset(leftpanel);

                }
                else if (edit == 1) //Code for upate operation
                {
                    DialogResult dr = MessageBox.Show("Are you sure, you want to update record?", "Question....", MessageBoxButtons.YesNo, MessageBoxIcon.Question);
                    if (dr == DialogResult.Yes)
                    {
                        Updation u = new Updation();
                        if (activeDD.SelectedIndex == 0)
                        {
                            stat = 1;
                        }
                        else if (activeDD.SelectedIndex == 1)
                        {
                            stat = 0;
                        }
                        u.updateCategory(catID, categorytxt.Text,stat);
                        r.ShowCategories(dataGridView1, catIDGV, NameGV, StatusGV);
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
                    d.Delete(catID, "st_deleteCategory", "@id");
                    r.ShowCategories(dataGridView1, catIDGV, NameGV,StatusGV);
                }


            }
        }

        public override void Searchtxt_TextChanged(object sender, EventArgs e)
        {

        }

        public override void ViewBtn_Click(object sender, EventArgs e)
        {
            r.ShowCategories(dataGridView1, catIDGV, NameGV, StatusGV);
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex != -1)
            {
                edit = 1;
                DataGridViewRow row = dataGridView1.Rows[e.RowIndex];
                catID = Convert.ToInt32(row.Cells["catIDGV"].Value.ToString());
                categorytxt.Text = row.Cells["NameGV"].Value.ToString();
                activeDD.SelectedItem = row.Cells["StatusGV"].Value.ToString();
                MainClass.disable(leftpanel);
            }
        }
    }
}
