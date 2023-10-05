using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Inventory_Management_System
{
    public partial class Users : Sample2
    {
        int edit = 0; //this 0 is indication to save operation and 1 in an indication update operation
        int userID;
        short stat;
        public Users()
        {
            InitializeComponent();
        }
        retrival r = new retrival();

        private void Users_Load(object sender, EventArgs e)
        {
            //MDI.logoutToolStripMenuItem.Enabled = true;
            userLabel.Text = retrival.EMP_NAME;
            MainClass.disable_reset(leftpanel);
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
            if (nametxt.Text == "") { nameErrorLabel.Visible = true; }
            else { nameErrorLabel.Visible = false; }
            //---User Name---
            if (usernametxt.Text == "") { userNameErrorLabel.Visible = true; }
            else { userNameErrorLabel.Visible = false; }
            //---Password---
            if (passwordtxt.Text == "") { passwordErrorLabel.Visible = true; }
            else { passwordErrorLabel.Visible = false; }
            //---Phone---
            if (phonetxt.Text == "") { phoneErrorLabel.Visible = true; }
            else { phoneErrorLabel.Visible = false; }
            //---Email---
            if (emailtxt.Text == "") { emailErrorLabel.Visible = true; }
            else { emailErrorLabel.Visible = false; }
            //---Status---
            if (statusDD.SelectedIndex == -1) { statusErrorLabel.Visible = true; }
            else { statusErrorLabel.Visible = false; }


            //Error is the type of msg
            if (nameErrorLabel.Visible || userNameErrorLabel.Visible || passwordErrorLabel.Visible || phoneErrorLabel.Visible || emailErrorLabel.Visible || statusErrorLabel.Visible)
            {
                MainClass.ShowMSG("Fields With * are mandatory", "Stop", "Error");
            }
            else
            {

                if (statusDD.SelectedIndex == 0)
                {
                    stat = 1;
                }
                else if (statusDD.SelectedIndex == 1)
                {
                    stat = 0;
                }
                if (edit == 0) //Code for save operation
                {

                    Insertion i = new Insertion();

                    i.InsertUser(nametxt.Text, usernametxt.Text, passwordtxt.Text, phonetxt.Text, emailtxt.Text,stat);
                    r.ShowUsers(dataGridView1,userIDGV,NameGV,UsernameGV,PasswordGV,PhoneGV,EmailGV,StatusGV);
                    MainClass.disable_reset(leftpanel);

                }
                else if (edit == 1) //Code for upate operation
                {
                    DialogResult dr = MessageBox.Show("Are you sure, you want to update record?","Question....",MessageBoxButtons.YesNo,MessageBoxIcon.Question);
                    if (dr == DialogResult.Yes)
                    {
                        Updation u = new Updation();
                        if (statusDD.SelectedIndex == 0)
                        {
                            stat = 1;
                        }
                        else if (statusDD.SelectedIndex == 1)
                        {
                            stat = 0;
                        }
                        u.UpdateUser(userID, nametxt.Text, usernametxt.Text, passwordtxt.Text, phonetxt.Text, emailtxt.Text, stat);
                        r.ShowUsers(dataGridView1, userIDGV, NameGV, UsernameGV, PasswordGV, PhoneGV, EmailGV, StatusGV);
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
                    d.Delete(userID, "st_deleteuser", "@id");
                    r.ShowUsers(dataGridView1, userIDGV, NameGV, UsernameGV, PasswordGV, PhoneGV, EmailGV, StatusGV);
                }
            }
        }

        public override void Searchtxt_TextChanged(object sender, EventArgs e)
        {
            if (Searchtxt.Text != "") 
            {
                r.ShowUsers(dataGridView1, userIDGV, NameGV, UsernameGV, PasswordGV, PhoneGV, EmailGV, StatusGV,Searchtxt.Text);
            }
            else 
            {
                r.ShowUsers(dataGridView1, userIDGV, NameGV, UsernameGV, PasswordGV, PhoneGV, EmailGV, StatusGV);
            }
        }

        public override void ViewBtn_Click(object sender, EventArgs e)
        {
            r.ShowUsers(dataGridView1, userIDGV, NameGV, UsernameGV, PasswordGV, PhoneGV, EmailGV, StatusGV);
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex != -1)
            {
                edit = 1;
                DataGridViewRow row = dataGridView1.Rows[e.RowIndex];
                userID = Convert.ToInt32(row.Cells["userIDGV"].Value.ToString());
                nametxt.Text = row.Cells["NameGV"].Value.ToString();
                usernametxt.Text = row.Cells["UsernameGV"].Value.ToString();
                passwordtxt.Text = row.Cells["PasswordGV"].Value.ToString();
                phonetxt.Text = row.Cells["PhoneGV"].Value.ToString();
                emailtxt.Text = row.Cells["EmailGV"].Value.ToString();
                statusDD.SelectedItem = row.Cells["StatusGV"].Value.ToString();
                MainClass.disable(leftpanel);
            }
        }
    }
}
