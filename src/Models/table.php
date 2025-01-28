<!-- In progress 

Purpose: To create a Table class that can render an HTML table based on a given table name, columns, and optional filters.
Problem: Hard to customize the table column names and sql statements with joins.

-->

<?php
namespace App\Models;
use App\Models\Db;

class Table {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function render($tableName, $columns, $filters = null) {
        
        $sql = "SELECT * FROM $tableName";
        if ($filters) {
            // If filters are provided, append them to the SQL query
            $sql .= " WHERE $filters";
        }

        // Fetch the data using the Db class
        $result = $this->db->query($sql);

        // Table structure
        echo '<div class="' . $tableName . '">';
        echo '<table id="' . $tableName . '-table">';
        echo '<thead><tr>';

        // Render table headers dynamically from $columns array
        foreach ($columns as $column) {
            echo "<th>$column</th>";
        }

        echo '</tr></thead>';
        echo '<tbody>';

        // Render table rows dynamically from the database result
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($columns as $column) {
                    echo "<td>{$row[$column]}</td>";
                }
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="' . count($columns) . '">No data available</td></tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    public function __destruct() {
        $this->db->close();
    }
}
?>