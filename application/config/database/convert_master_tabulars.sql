UPDATE master_tabulars 
  SET parent_id = 
    IF(LEFT(REVERSE(ancestry),1) = 0,
      CONCAT(REVERSE(CONVERT(REVERSE(ancestry),SIGNED)),"0"), 
      CONVERT(REVERSE(ancestry),SIGNED))